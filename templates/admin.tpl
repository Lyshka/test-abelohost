<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{$title}</title>
  <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body class="site">
  <header class="topbar">
    <div class="topbar__inner">
      <a class="brand" href="/">Blogy.</a>
      <div>
        <a class="btn" href="/">Главная</a>
        <a class="btn" href="/?action=admin-logout">Выход</a>
      </div>
    </div>
  </header>

  <main class="main">
    <h1 class="page-title">{$title}</h1>
    <div class="panel panel--compact">
      {if $seeded}
        <div class="card__meta">Сидинг выполнен</div>
      {/if}
      <form class="form" method="post" action="/?action=seed">
        <button type="submit">Заполнить тестовыми категориями и статьями</button>
      </form>
    </div>
    <div class="panel-grid">
      <div class="panel">
        <h2 class="panel__title">Добавить категорию</h2>
        <form class="form" method="post" action="/?action=create-category">
          <label>Название</label>
          <input type="text" name="name" required>
          <label>Описание</label>
          <textarea name="description" rows="3"></textarea>
          <button type="submit">Сохранить категорию</button>
        </form>
      </div>

      <div class="panel">
        <h2 class="panel__title">Добавить статью</h2>
        <form class="form" method="post" action="/?action=create-article" enctype="multipart/form-data">
          <label>Изображение</label>
          <input type="file" name="image" accept="image/*">
          <label>Название</label>
          <input type="text" name="title" required>
          <label>Описание</label>
          <textarea name="description" rows="3"></textarea>
          <label>Текст</label>
          <textarea name="body" rows="8" required></textarea>
          <label>Категория (одна или несколько)</label>
          <select name="category_ids[]" multiple size="8">
            {foreach $categories as $category}
              <option value="{$category.id}">{$category.name}</option>
            {/foreach}
          </select>
          <button type="submit">Сохранить статью</button>
        </form>
      </div>
    </div>
  </main>

  <footer class="footer">
    <div class="footer__inner">Copyright 2026. All Rights Reserved</div>
  </footer>
</body>
</html>
