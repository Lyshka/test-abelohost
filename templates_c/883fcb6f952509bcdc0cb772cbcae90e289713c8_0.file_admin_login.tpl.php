<?php
/* Smarty version 5.8.0, created on 2026-04-03 21:04:16
  from 'file:admin_login.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d02b50319864_59616029',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '883fcb6f952509bcdc0cb772cbcae90e289713c8' => 
    array (
      0 => 'admin_login.tpl',
      1 => 1775250236,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69d02b50319864_59616029 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/var/www/html/templates';
?><!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $_smarty_tpl->getValue('title');?>
</title>
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
        <h1 class="page-title"><?php echo $_smarty_tpl->getValue('title');?>
</h1>
        <form class="form" method="post" action="/?action=admin-login">
          <?php if ($_smarty_tpl->getValue('hasError')) {?>
            <div class="error">Неверный пароль</div>
          <?php }?>
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
<?php }
}
