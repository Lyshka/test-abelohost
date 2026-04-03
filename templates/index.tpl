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
        {if $isAdmin}
          <a class="btn" href="/?action=admin">Админка</a>
          <a class="btn" href="/?action=admin-logout">Выход</a>
        {else}
          <a class="btn" href="/?action=admin">Вход в админку</a>
        {/if}
      </div>
    </div>
  </header>

  <main class="main">
    {foreach $categories as $category}
      <section class="section">
        <div class="section__head">
          <h2 class="section__title">{$category.name}</h2>
          <a class="btn btn--link" href="/?action=category&id={$category.id}">View All</a>
        </div>
        <p class="section__description">{$category.description|default:'-'}</p>
        <div class="cards">
          {foreach $category.articles as $article}
            <article class="card">
              {if $article.image}
                <img class="card__image" src="{$article.image}" alt="{$article.title}">
              {/if}
              <h3 class="card__title"><a href="/?action=article&id={$article.id}">{$article.title}</a></h3>
              <div class="card__meta">{$article.created_at}</div>
              <p class="card__text">{$article.description|default:''}</p>
              <a class="btn btn--link" href="/?action=article&id={$article.id}">Continue Reading</a>
            </article>
          {foreachelse}
            <div class="empty">В этой категории пока нет статей</div>
          {/foreach}
        </div>
      </section>
    {foreachelse}
      <div class="empty">Категорий со статьями пока нет</div>
    {/foreach}
  </main>

  <footer class="footer">
    <div class="footer__inner">Copyright 2026. All Rights Reserved</div>
  </footer>
</body>
</html>
