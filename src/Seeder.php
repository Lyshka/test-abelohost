<?php

declare(strict_types=1);

namespace App;

use PDO;

final class Seeder
{
    public function __construct(private readonly PDO $pdo)
    {
    }

    public function run(): void
    {
        $this->pdo->exec('SET FOREIGN_KEY_CHECKS=0');
        $this->pdo->exec('TRUNCATE TABLE article_category');
        $this->pdo->exec('TRUNCATE TABLE articles');
        $this->pdo->exec('TRUNCATE TABLE categories');
        $this->pdo->exec('SET FOREIGN_KEY_CHECKS=1');

        $categories = [
            ['Технологии', 'Новости мира разработки и IT'],
            ['Бизнес', 'Актуальные статьи о бизнесе и рынке'],
            ['Маркетинг', 'Материалы о продвижении и рекламе'],
            ['Дизайн', 'Тренды интерфейсов и визуала'],
        ];

        $categoryStmt = $this->pdo->prepare(
            'INSERT INTO categories (name, description) VALUES (:name, :description)'
        );

        $categoryIds = [];
        foreach ($categories as [$name, $description]) {
            $categoryStmt->execute([
                ':name' => $name,
                ':description' => $description,
            ]);
            $categoryIds[] = (int) $this->pdo->lastInsertId();
        }

        $articles = [
            [
                'title' => 'Как выбрать стек для нового проекта',
                'description' => 'Практический разбор подходов к выбору технологий.',
                'body' => 'Материал о том, как оценивать требования проекта, команду и сроки перед выбором стека.',
                'image' => 'https://picsum.photos/id/1060/900/560',
                'views' => 124,
                'categories' => [0, 1],
            ],
            [
                'title' => 'Тренды UI в 2026 году',
                'description' => 'Что меняется в интерфейсах и почему.',
                'body' => 'Краткий обзор современных паттернов интерфейсов, типографики и композиции.',
                'image' => 'https://picsum.photos/id/1005/900/560',
                'views' => 98,
                'categories' => [3],
            ],
            [
                'title' => 'SEO-стратегия для контентных проектов',
                'description' => 'Базовые шаги для стабильного органического роста.',
                'body' => 'Структура контента, кластеризация запросов и регулярный аудит как основа роста трафика.',
                'image' => 'https://picsum.photos/id/1033/900/560',
                'views' => 207,
                'categories' => [2, 1],
            ],
            [
                'title' => 'Юнит-экономика простыми словами',
                'description' => 'Как считать ключевые метрики без сложных формул.',
                'body' => 'Объяснение CAC, LTV, маржинальности и их влияния на прибыльность продукта.',
                'image' => 'https://picsum.photos/id/1044/900/560',
                'views' => 173,
                'categories' => [1],
            ],
            [
                'title' => 'Оптимизация производительности PHP-приложения',
                'description' => 'Что дает максимальный эффект в первую очередь.',
                'body' => 'Кэширование, профилирование запросов к БД и настройка окружения для стабильной скорости.',
                'image' => 'https://picsum.photos/id/1040/900/560',
                'views' => 156,
                'categories' => [0],
            ],
            [
                'title' => 'Контент-план на месяц для блога',
                'description' => 'Шаблон планирования и распределения тем.',
                'body' => 'Подход к формированию контентной сетки с учетом целей и ресурсов команды.',
                'image' => 'https://picsum.photos/id/1025/900/560',
                'views' => 84,
                'categories' => [2],
            ],
            [
                'title' => 'Система дизайна для команды',
                'description' => 'Как стандартизировать интерфейсы и ускорить разработку.',
                'body' => 'Компонентный подход, правила именования и внедрение дизайн-системы в процесс.',
                'image' => 'https://picsum.photos/id/1011/900/560',
                'views' => 119,
                'categories' => [3, 0],
            ],
            [
                'title' => 'Как подготовить продукт к масштабированию',
                'description' => 'Точки роста и контроль рисков.',
                'body' => 'Архитектура, процессы и аналитика как базовые элементы масштабируемого продукта.',
                'image' => 'https://picsum.photos/id/1058/900/560',
                'views' => 232,
                'categories' => [1, 0],
            ],
        ];

        $articleStmt = $this->pdo->prepare(
            'INSERT INTO articles (image, title, description, body, views_count)
             VALUES (:image, :title, :description, :body, :views_count)'
        );
        $linkStmt = $this->pdo->prepare(
            'INSERT INTO article_category (article_id, category_id) VALUES (:article_id, :category_id)'
        );

        foreach ($articles as $article) {
            $articleStmt->execute([
                ':image' => $article['image'],
                ':title' => $article['title'],
                ':description' => $article['description'],
                ':body' => $article['body'],
                ':views_count' => $article['views'],
            ]);

            $articleId = (int) $this->pdo->lastInsertId();

            foreach ($article['categories'] as $categoryIndex) {
                $linkStmt->execute([
                    ':article_id' => $articleId,
                    ':category_id' => $categoryIds[(int) $categoryIndex],
                ]);
            }
        }
    }
}
