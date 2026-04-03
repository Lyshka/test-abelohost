# Blogy (PHP + Smarty + MySQL + Docker)

Полноценный мини-CMS/блог на PHP 8.2 с шаблонизатором Smarty, MySQL, админкой, сидинговыми данными, сортировкой, пагинацией и похожими статьями.

## Возможности

- Главная страница с категориями, где есть статьи
- Вывод 3 последних статей в каждой категории
- Кнопка `View All` для перехода в категорию
- Страница категории:
  - название и описание
  - список статей
  - сортировка по дате и просмотрам
  - пагинация
- Страница статьи:
  - полная информация
  - автоувеличение просмотров
  - блок из 3 похожих статей
- Админка с паролем:
  - создание категорий
  - создание статей (включая изображение и выбор нескольких категорий)
  - запуск сидинга
- SCSS/CSS стили для всех страниц

## Стек

- PHP `8.2` + Apache
- MySQL `8.0`
- Smarty `5.x`
- Docker + Docker Compose

## Запуск проекта

### 1) Клонировать репозиторий

```bash
git clone <your-repo-url>
cd test-abelohost
```

### 2) Запустить контейнеры

```bash
docker compose up --build
```

После запуска проект будет доступен:

- Приложение: [http://localhost:8080](http://localhost:8080)
- MySQL: `localhost:3306`

## Конфигурация

Основные переменные находятся в `docker-compose.yml`.

### PHP сервис

- `ADMIN_PASSWORD=admin` — пароль для входа в админку

### MySQL сервис

- `MYSQL_ROOT_PASSWORD=root`
- `MYSQL_DATABASE=app`
- `MYSQL_USER=app`
- `MYSQL_PASSWORD=app`

## Админка

- Страница входа: `/?action=admin`
- По умолчанию пароль: `admin`

После входа доступны:

- добавление категорий
- добавление статей
- запуск сидинга тестовых данных

## Сидинг данных

### Через админку

Кнопка в админке:

- `Заполнить тестовыми категориями и статьями`

### Через CLI

```bash
docker compose exec -T php composer seed
```

или

```bash
docker compose exec -T php php scripts/seed.php
```

Важно: сидинг очищает таблицы `categories`, `articles`, `article_category` и заполняет их заново.

## Основные маршруты

- `/` — главная
- `/?action=category&id={id}&sort=date|views&page={n}` — категория
- `/?action=article&id={id}` — статья
- `/?action=admin` — вход/панель админа
- `/?action=admin-logout` — выход из админки

## Структура проекта

```text
public/
  index.php
  uploads/
  assets/
    scss/main.scss
    css/main.css
src/
  Database.php
  Schema.php
  CategoryRepository.php
  ArticleRepository.php
  Seeder.php
scripts/
  seed.php
templates/
  index.tpl
  category.tpl
  article.tpl
  admin.tpl
  admin_login.tpl
docker-compose.yml
Dockerfile
composer.json
```

## Полезные команды

```bash
docker compose up --build
docker compose down
docker compose exec -T php composer install
docker compose exec -T php composer seed
```

## Лицензия

Используйте и модифицируйте проект под свои задачи.
