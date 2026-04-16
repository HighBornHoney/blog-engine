<?php

declare(strict_types=1);

namespace HighBornHoney\BlogEngine\Core;

use PDO;

class Database
{
    private static ?PDO $pdo = null;

    public static function connect(): PDO
    {
        if (!self::$pdo) {
            $config = require __DIR__ . '/../../config/database.php';

            self::$pdo = new PDO(
                $config['dsn'],
                $config['user'],
                $config['password'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]
            );
        }

        return self::$pdo;
    }
}
