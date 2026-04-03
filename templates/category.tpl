<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{$category.name}</title>
  <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body class="site">
  <header class="topbar">
    <div class="topbar__inner">
      <a class="brand" href="/">Blogy.</a>
      <div>
        <a class="btn" href="/">Главная</a>
        <a class="btn" href="/?action=admin">Админка</a>
      </div>
    </div>
  </header>

  <main class="main">
    <h1 class="page-title">{$category.name}</h1>
    <p class="section__description">{$category.description|default:'-'}</p>

    <div class="tools">
      <div class="sort">
        <span class="sort__label">Сортировка:</span>
        <a class="btn btn--dark" href="/?action=category&id={$categoryId}&sort=date&page=1">По дате</a>
        <a class="btn btn--dark" href="/?action=category&id={$categoryId}&sort=views&page=1">По просмотрам</a>
      </div>
    </div>

    <div class="cards">
      {foreach $articles as $article}
        <article class="card">
          {if $article.image}
            <img class="card__image" src="{$article.image}" alt="{$article.title}">
          {/if}
          <h3 class="card__title"><a href="/?action=article&id={$article.id}">{$article.title}</a></h3>
          <div class="card__meta">{$article.created_at}</div>
          <p class="card__text">{$article.description|default:''}</p>
          <div class="card__meta">Просмотры: {$article.views_count}</div>
          <a class="btn btn--link" href="/?action=article&id={$article.id}">Continue Reading</a>
        </article>
      {foreachelse}
        <div class="empty">Статей в категории нет</div>
      {/foreach}
    </div>

    <div class="pagination">
      {if $page > 1}
        <a class="btn btn--dark" href="/?action=category&id={$categoryId}&sort={$sort}&page={$page-1}">Назад</a>
      {/if}
      <span class="pagination__text">Страница {$page} из {$totalPages}</span>
      {if $page < $totalPages}
        <a class="btn btn--dark" href="/?action=category&id={$categoryId}&sort={$sort}&page={$page+1}">Вперед</a>
      {/if}
    </div>
  </main>

  <footer class="footer">
    <div class="footer__inner">Copyright 2026. All Rights Reserved</div>
  </footer>
</body>
</html>
