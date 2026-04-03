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
      </div>
    </div>
  </header>

  <main class="main">
    <div class="auth">
      <div class="panel">
        <h1 class="page-title">{$title}</h1>
        <form class="form" method="post" action="/?action=admin-login">
          {if $hasError}
            <div class="error">Неверный пароль</div>
          {/if}
          <label>Пароль</label>
          <input type="password" name="password" required>
          <button type="submit">Войти</button>
        </form>
      </div>
    </div>
  </main>

  <footer class="footer">
    <div class="footer__inner">Copyright 2026. All Rights Reserved</div>
  </footer>
</body>
</html>
