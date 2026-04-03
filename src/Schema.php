<?php

declare(strict_types=1);

namespace App;

use PDO;

final class Schema
{
    public static function ensure(PDO $pdo): void
    {
        $pdo->exec(
            'CREATE TABLE IF NOT EXISTS categories (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                description TEXT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
        );

        $pdo->exec(
            'CREATE TABLE IF NOT EXISTS articles (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                image VARCHAR(255) NULL,
                title VARCHAR(255) NOT NULL,
                description TEXT NULL,
                body LONGTEXT NOT NULL,
                views_count BIGINT UNSIGNED NOT NULL DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
        );

        $pdo->exec(
            'CREATE TABLE IF NOT EXISTS article_category (
                article_id BIGINT UNSIGNED NOT NULL,
                category_id BIGINT UNSIGNED NOT NULL,
                PRIMARY KEY (article_id, category_id),
                CONSTRAINT fk_article_category_article
                    FOREIGN KEY (article_id) REFERENCES articles(id)
                    ON DELETE CASCADE,
                CONSTRAINT fk_article_category_category
                    FOREIGN KEY (category_id) REFERENCES categories(id)
                    ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
        );
    }
}
