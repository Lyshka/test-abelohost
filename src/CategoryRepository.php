<?php

declare(strict_types=1);

namespace App;

use PDO;

final class CategoryRepository
{
    public function __construct(private readonly PDO $pdo)
    {
    }

    public function all(): array
    {
        $stmt = $this->pdo->query('SELECT id, name, description FROM categories ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT id, name, description FROM categories WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $category = $stmt->fetch();

        return $category === false ? null : $category;
    }

    public function withLatestArticles(int $limitPerCategory = 3): array
    {
        $stmt = $this->pdo->query(
            'SELECT DISTINCT c.id, c.name, c.description
             FROM categories c
             INNER JOIN article_category ac ON ac.category_id = c.id
             INNER JOIN articles a ON a.id = ac.article_id
             ORDER BY c.name'
        );
        $categories = $stmt->fetchAll();

        $articleStmt = $this->pdo->prepare(
            'SELECT a.id, a.title, a.description, a.image, a.views_count, a.created_at
             FROM articles a
             INNER JOIN article_category ac ON ac.article_id = a.id
             WHERE ac.category_id = :category_id
             ORDER BY a.created_at DESC, a.id DESC
             LIMIT :limit'
        );
        $articleStmt->bindParam(':limit', $limitPerCategory, PDO::PARAM_INT);

        foreach ($categories as $index => $category) {
            $categoryId = (int) $category['id'];
            $articleStmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
            $articleStmt->execute();
            $categories[$index]['articles'] = $articleStmt->fetchAll();
        }

        return $categories;
    }

    public function create(string $name, ?string $description): void
    {
        $stmt = $this->pdo->prepare('INSERT INTO categories (name, description) VALUES (:name, :description)');
        $stmt->execute([
            ':name' => $name,
            ':description' => $description,
        ]);
    }
}
