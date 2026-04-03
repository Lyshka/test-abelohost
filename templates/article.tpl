<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{$article.title}</title>
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
    <article class="article">
      <h1 class="article__title">{$article.title}</h1>
      {if $article.image}
        <img class="article__image" src="{$article.image}" alt="{$article.title}">
      {/if}
      <p class="card__text">{$article.description|default:''}</p>
      <div class="article__meta">
        Просмотры: {$article.views_count}
        |
        Дата публикации: {$article.created_at}
        |
        Категории:
        {foreach $article.categories as $category}
          {$category.name}{if !$category@last}, {/if}
        {foreachelse}
          -
        {/foreach}
      </div>
      <div class="article__body">{$article.body}</div>
    </article>

    <section class="section">
      <div class="section__head">
        <h2 class="section__title">Похожие статьи</h2>
      </div>
      <div class="cards">
        {foreach $similarArticles as $item}
          <article class="card">
            {if $item.image}
              <img class="card__image" src="{$item.image}" alt="{$item.title}">
            {/if}
            <h3 class="card__title"><a href="/?action=article&id={$item.id}">{$item.title}</a></h3>
            <div class="card__meta">{$item.created_at}</div>
            <p class="card__text">{$item.description|default:''}</p>
            <a class="btn btn--link" href="/?action=article&id={$item.id}">Continue Reading</a>
          </article>
        {foreachelse}
          <div class="empty">Похожих статей нет</div>
        {/foreach}
      </div>
    </section>
  </main>

  <footer class="footer">
    <div class="footer__inner">Copyright 2026. All Rights Reserved</div>
  </footer>
</body>
</html>
