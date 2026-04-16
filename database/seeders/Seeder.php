<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Faker\Factory as Faker;
use HighBornHoney\BlogEngine\Core\Database;

class Seeder
{
    public static function run(): void
    {
        $pdo = Database::connect();

        self::truncate($pdo);

        $categoryIds = self::seedCategories($pdo);
        $postIds = self::seedPosts($pdo);

        self::seedRelations($pdo, $postIds, $categoryIds);

        echo "Seeding completed successfully\n";
    }

    private static function truncate(PDO $pdo): void
    {
        $pdo->exec("SET FOREIGN_KEY_CHECKS=0");

        $pdo->exec("TRUNCATE post_category");
        $pdo->exec("TRUNCATE posts");
        $pdo->exec("TRUNCATE categories");

        $pdo->exec("SET FOREIGN_KEY_CHECKS=1");
    }

    private static function seedCategories(PDO $pdo): array
    {
        $categories = [
            ['Технологии', 'Новости технологий и обучающие материалы'],
            ['Путешествия', 'Путеводители и опыт путешествий'],
            ['Еда', 'Рецепты и обзоры еды'],
            ['Образ жизни', 'Повседневная жизнь и советы по продуктивности'],
            ['Бизнес', 'Бизнес-идеи и стратегии'],
        ];

        $ids = [];

        foreach ($categories as $cat) {
            $stmt = $pdo->prepare(
                "
                INSERT INTO categories (name, description)
                VALUES (?, ?)
            "
            );

            $stmt->execute($cat);

            $ids[] = (int)$pdo->lastInsertId();
        }

        return $ids;
    }

    private static function seedPosts(PDO $pdo): array
    {
        $faker = Faker::create('ru_RU');

        $ids = [];

        for ($i = 0; $i < 30; $i++) {
            $stmt = $pdo->prepare(
                "INSERT INTO posts (title, description, content, image, views, created_at) VALUES (?, ?, ?, ?, ?, ?)"
            );

            $stmt->execute([
                $faker->realText(50),
                $faker->realText(100),
                $faker->realText(1000),
                $faker->imageUrl(640, 480, ['tech', 'travel', 'food'][rand(0, 2)]),
                $faker->numberBetween(0, 1000),
                $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s')
            ]);

            $ids[] = (int)$pdo->lastInsertId();
        }

        return $ids;
    }

    private static function seedRelations(PDO $pdo, array $postIds, array $categoryIds): void
    {
        foreach ($postIds as $postId) {
            $randomKeys = (array)array_rand($categoryIds, rand(1, 2));

            foreach ($randomKeys as $key) {
                $stmt = $pdo->prepare("INSERT INTO post_category (post_id, category_id) VALUES (?, ?)");

                $stmt->execute([
                    $postId,
                    $categoryIds[$key]
                ]);
            }
        }
    }
}

Seeder::run();
