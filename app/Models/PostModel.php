<?php

declare(strict_types=1);

namespace HighBornHoney\BlogEngine\Models;

use PDO;

class PostModel extends BaseModel
{
    public static function find(int $id): ?array
    {
        $pdo = self::db();

        $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");

        $stmt->execute([$id]);

        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        return $post ?: null;
    }

    public static function incrementViews(int $id): void
    {
        $pdo = self::db();

        $stmt = $pdo->prepare("UPDATE posts SET views = views + 1 WHERE id = ?");

        $stmt->execute([$id]);
    }

    public static function getByCategory(
        int $categoryId,
        string $sort = 'date',
        int $page = 1,
        int $perPage = 5
    ): array {
        $pdo = self::db();

        $offset = ($page - 1) * $perPage;

        $orderBy = $sort === 'views'
            ? 'p.views DESC'
            : 'p.created_at DESC';

        $stmt = $pdo->prepare(
            "
        SELECT p.*
        FROM posts p
        JOIN post_category pc ON pc.post_id = p.id
        WHERE pc.category_id = ?
        ORDER BY $orderBy
        LIMIT ? OFFSET ?
    "
        );

        $stmt->bindValue(1, $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(2, $perPage, PDO::PARAM_INT);
        $stmt->bindValue(3, $offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function countByCategory(int $categoryId): int
    {
        $pdo = self::db();

        $stmt = $pdo->prepare(
            "
        SELECT COUNT(*)
        FROM post_category
        WHERE category_id = ?
    "
        );

        $stmt->execute([$categoryId]);

        return (int)$stmt->fetchColumn();
    }

    public static function getRelated(int $postId, int $limit = 3): array
    {
        $pdo = self::db();

        $stmt = $pdo->prepare(
            "
        SELECT DISTINCT p.*
        FROM posts p
        JOIN post_category pc ON pc.post_id = p.id
        WHERE pc.category_id IN (
            SELECT category_id
            FROM post_category
            WHERE post_id = ?
        )
        AND p.id != ?
        LIMIT ?
    "
        );

        $stmt->bindValue(1, $postId, PDO::PARAM_INT);
        $stmt->bindValue(2, $postId, PDO::PARAM_INT);
        $stmt->bindValue(3, $limit, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
