<?php

declare(strict_types=1);

namespace HighBornHoney\BlogEngine\Core;

class Router
{
    private array $routes = [];

    public function get(string $uri, string $action): void
    {
        $this->routes['GET'][$this->format($uri)] = $action;
    }

    private function format(string $uri): string
    {
        return rtrim($uri, '/') ?: '/';
    }

    public function dispatch(string $method, string $uri): void
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = $this->format($uri);

        foreach ($this->routes[$method] ?? [] as $route => $action) {
            $pattern = preg_replace('#\{[a-zA-Z]+\}#', '([0-9]+)', $route);

            if (preg_match("#^$pattern$#", $uri, $matches)) {
                array_shift($matches);
                array_walk($matches, fn(&$value) => $value = (int)$value);

                [$controller, $methodName] = explode('@', $action);

                $controller = "HighBornHoney\\BlogEngine\\Controllers\\$controller";

                (new $controller)->$methodName(...$matches);
                return;
            }
        }

        http_response_code(404);
    }
}
