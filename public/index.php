<?php

declare(strict_types=1);

session_start();

require __DIR__ . '/../vendor/autoload.php';

use App\ArticleRepository;
use App\CategoryRepository;
use App\Database;
use App\Seeder;
use App\Schema;

$smarty = new Smarty\Smarty();
$smarty->setTemplateDir(__DIR__ . '/../templates');
$smarty->setCompileDir(__DIR__ . '/../templates_c');
$smarty->setCacheDir(__DIR__ . '/../cache');
$smarty->setConfigDir(__DIR__ . '/../configs');

$pdo = Database::connection();
Schema::ensure($pdo);

$categoryRepository = new CategoryRepository($pdo);
$articleRepository = new ArticleRepository($pdo);

$uploadsPath = __DIR__ . '/uploads';
if (!is_dir($uploadsPath)) {
    mkdir($uploadsPath, 0777, true);
}

$adminPassword = (string) (getenv('ADMIN_PASSWORD') ?: 'admin');
$isAdmin = ($_SESSION['is_admin'] ?? false) === true;
$action = $_GET['action'] ?? 'home';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'admin-login') {
    $password = (string) ($_POST['password'] ?? '');

    if (hash_equals($adminPassword, $password)) {
        $_SESSION['is_admin'] = true;
        header('Location: /?action=admin');
        exit;
    }

    header('Location: /?action=admin&error=1');
    exit;
}

if ($action === 'admin-logout') {
    $_SESSION = [];
    session_destroy();
    header('Location: /');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'create-category') {
    if (!$isAdmin) {
        http_response_code(403);
        echo 'Forbidden';
        exit;
    }

    $name = trim((string) ($_POST['name'] ?? ''));
    $description = trim((string) ($_POST['description'] ?? ''));

    if ($name !== '') {
        $categoryRepository->create($name, $description !== '' ? $description : null);
    }

    header('Location: /?action=admin');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'create-article') {
    if (!$isAdmin) {
        http_response_code(403);
        echo 'Forbidden';
        exit;
    }

    $title = trim((string) ($_POST['title'] ?? ''));
    $description = trim((string) ($_POST['description'] ?? ''));
    $body = trim((string) ($_POST['body'] ?? ''));
    $categoryIds = $_POST['category_ids'] ?? [];
    $imagePath = null;

    if (is_array($categoryIds)) {
        $categoryIds = array_map('intval', $categoryIds);
    } else {
        $categoryIds = [];
    }

    if (
        isset($_FILES['image']) &&
        is_array($_FILES['image']) &&
        ($_FILES['image']['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_OK
    ) {
        $tmpName = (string) $_FILES['image']['tmp_name'];
        $originalName = (string) $_FILES['image']['name'];
        $ext = pathinfo($originalName, PATHINFO_EXTENSION);
        $safeExt = preg_replace('/[^a-zA-Z0-9]/', '', $ext);
        $filename = bin2hex(random_bytes(16));
        $filename = $safeExt !== '' ? $filename . '.' . strtolower($safeExt) : $filename;
        $fullPath = $uploadsPath . '/' . $filename;

        if (move_uploaded_file($tmpName, $fullPath)) {
            $imagePath = '/uploads/' . $filename;
        }
    }

    if ($title !== '' && $body !== '') {
        $articleRepository->create(
            $title,
            $description !== '' ? $description : null,
            $body,
            $imagePath,
            $categoryIds
        );
    }

    header('Location: /?action=admin');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'seed') {
    if (!$isAdmin) {
        http_response_code(403);
        echo 'Forbidden';
        exit;
    }

    $seeder = new Seeder($pdo);
    $seeder->run();

    header('Location: /?action=admin&seeded=1');
    exit;
}

if ($action === 'admin') {
    if (!$isAdmin) {
        $smarty->assign('title', 'Вход в админку');
        $smarty->assign('hasError', ($_GET['error'] ?? '') === '1');
        $smarty->display('admin_login.tpl');
        exit;
    }

    $smarty->assign('title', 'Админка');
    $smarty->assign('categories', $categoryRepository->all());
    $smarty->assign('seeded', ($_GET['seeded'] ?? '') === '1');
    $smarty->display('admin.tpl');
    exit;
}

if ($action === 'category') {
    $categoryId = (int) ($_GET['id'] ?? 0);
    $category = $categoryRepository->find($categoryId);

    if ($category === null) {
        http_response_code(404);
        echo 'Not found';
        exit;
    }

    $sort = (string) ($_GET['sort'] ?? 'date');
    if (!in_array($sort, ['date', 'views'], true)) {
        $sort = 'date';
    }

    $perPage = 6;
    $page = max(1, (int) ($_GET['page'] ?? 1));
    $total = $articleRepository->countByCategory($categoryId);
    $totalPages = max(1, (int) ceil($total / $perPage));
    if ($page > $totalPages) {
        $page = $totalPages;
    }
    $offset = ($page - 1) * $perPage;

    $articles = $articleRepository->byCategory($categoryId, $sort, $perPage, $offset);

    $smarty->assign('title', $category['name']);
    $smarty->assign('category', $category);
    $smarty->assign('articles', $articles);
    $smarty->assign('sort', $sort);
    $smarty->assign('page', $page);
    $smarty->assign('totalPages', $totalPages);
    $smarty->assign('categoryId', $categoryId);
    $smarty->display('category.tpl');
    exit;
}

if ($action === 'article') {
    $id = (int) ($_GET['id'] ?? 0);

    if ($id > 0) {
        $articleRepository->incrementViews($id);
        $article = $articleRepository->findWithCategories($id);
        $similarArticles = $articleRepository->similar($id, 3);

        if ($article !== null) {
            $smarty->assign('article', $article);
            $smarty->assign('similarArticles', $similarArticles);
            $smarty->display('article.tpl');
            exit;
        }
    }

    http_response_code(404);
    echo 'Not found';
    exit;
}

$smarty->assign('title', 'Главная');
$smarty->assign('categories', $categoryRepository->withLatestArticles(3));
$smarty->assign('isAdmin', $isAdmin);

$smarty->display('index.tpl');
