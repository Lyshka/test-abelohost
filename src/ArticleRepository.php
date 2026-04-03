<?php

declare(strict_types=1);

namespace App;

use PDO;

final class ArticleRepository
{
    public function __construct(private readonly PDO $pdo)
    {
    }

    public function allWithCategories(): array
    {
        $stmt = $this->pdo->query(
            'SELECT a.id, a.image, a.title, a.description, a.views_count, a.created_at,
                    GROUP_CONCAT(c.name ORDER BY c.name SEPARATOR ", ") AS categories
             FROM articles a
             LEFT JOIN article_category ac ON ac.article_id = a.id
             LEFT JOIN categories c ON c.id = ac.category_id
             GROUP BY a.id
             ORDER BY a.id DESC'
        );

        return $stmt->fetchAll();
    }

    public function byCategory(int $categoryId, string $sort, int $limit, int $offset): array
    {
        $orderBy = $sort === 'views' ? 'a.views_count DESC, a.created_at DESC' : 'a.created_at DESC, a.id DESC';

        $sql = sprintf(
            'SELECT a.id, a.image, a.title, a.description, a.views_count, a.created_at
             FROM articles a
             INNER JOIN article_category ac ON ac.article_id = a.id
             WHERE ac.category_id = :category_id
             ORDER BY %s
             LIMIT :limit OFFSET :offset',
            $orderBy
        );

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function countByCategory(int $categoryId): int
    {
        $stmt = $this->pdo->prepare(
            'SELECT COUNT(*) AS total
             FROM articles a
             INNER JOIN article_category ac ON ac.article_id = a.id
             WHERE ac.category_id = :category_id'
        );
        $stmt->execute([':category_id' => $categoryId]);

        return (int) $stmt->fetchColumn();
    }

    public function create(
        string $title,
        ?string $description,
        string $body,
        ?string $image,
        array $categoryIds
    ): void {
        $this->pdo->beginTransaction();

        $stmt = $this->pdo->prepare(
            'INSERT INTO articles (image, title, description, body) VALUES (:image, :title, :description, :body)'
        );
        $stmt->execute([
            ':image' => $image,
            ':title' => $title,
            ':description' => $description,
            ':body' => $body,
        ]);

        $articleId = (int) $this->pdo->lastInsertId();

        if ($categoryIds !== []) {
            $linkStmt = $this->pdo->prepare(
                'INSERT INTO article_category (article_id, category_id) VALUES (:article_id, :category_id)'
            );

            foreach ($categoryIds as $categoryId) {
                $linkStmt->execute([
                    ':article_id' => $articleId,
                    ':category_id' => (int) $categoryId,
                ]);
            }
        }

        $this->pdo->commit();
    }

    public function findWithCategories(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, image, title, description, body, views_count, created_at
             FROM articles
             WHERE id = :id
             LIMIT 1'
        );
        $stmt->execute([':id' => $id]);
        $article = $stmt->fetch();

        if ($article === false) {
            return null;
        }

        $catStmt = $this->pdo->prepare(
            'SELECT c.id, c.name
             FROM categories c
             INNER JOIN article_category ac ON ac.category_id = c.id
             WHERE ac.article_id = :article_id
             ORDER BY c.name'
        );
        $catStmt->execute([':article_id' => $id]);
        $article['categories'] = $catStmt->fetchAll();

        return $article;
    }

    public function incrementViews(int $id): void
    {
        $stmt = $this->pdo->prepare('UPDATE articles SET views_count = views_count + 1 WHERE id = :id');
        $stmt->execute([':id' => $id]);
    }

    public function similar(int $articleId, int $limit = 3): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT a.id, a.title, a.description, a.image, a.views_count, a.created_at,
                    COUNT(*) AS common_categories
             FROM articles a
             INNER JOIN article_category ac ON ac.article_id = a.id
             WHERE a.id <> :article_id
               AND ac.category_id IN (
                   SELECT category_id
                   FROM article_category
                   WHERE article_id = :article_id
               )
             GROUP BY a.id
             ORDER BY common_categories DESC, a.created_at DESC
             LIMIT :limit'
        );
        $stmt->bindValue(':article_id', $articleId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
