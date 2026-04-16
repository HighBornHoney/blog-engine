<?php

declare(strict_types=1);

namespace HighBornHoney\BlogEngine\Models;

use PDO;

class CategoryModel extends BaseModel
{
    public static function find(int $id): ?array
    {
        $pdo = self::db();

        $stmt = $pdo->prepare("SELECT * FROM categories WHERE id = ?");

        $stmt->execute([$id]);

        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        return $category ?: null;
    }

    public static function getWithLatestPosts(int $limit = 3): array
    {
        $pdo = self::db();

        $categories = $pdo->query(
            "
            SELECT DISTINCT c.*
            FROM categories c
            JOIN post_category pc ON pc.category_id = c.id
        "
        )->fetchAll(PDO::FETCH_ASSOC);

        foreach ($categories as &$category) {
            $stmt = $pdo->prepare(
                "
                SELECT p.*
                FROM posts p
                JOIN post_category pc ON pc.post_id = p.id
                WHERE pc.category_id = ?
                ORDER BY p.created_at DESC
                LIMIT ?
            "
            );

            $stmt->bindValue(1, $category['id'], PDO::PARAM_INT);
            $stmt->bindValue(2, $limit, PDO::PARAM_INT);
            $stmt->execute();

            $category['posts'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $categories;
    }
}
