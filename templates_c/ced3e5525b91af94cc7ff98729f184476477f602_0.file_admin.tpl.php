<?php
/* Smarty version 5.8.0, created on 2026-04-03 21:50:28
  from 'file:admin.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d03624f02f85_29319228',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ced3e5525b91af94cc7ff98729f184476477f602' => 
    array (
      0 => 'admin.tpl',
      1 => 1775252964,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69d03624f02f85_29319228 (\Smarty\Template $_smarty_tpl) {
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
        <a class="btn" href="/?action=admin-logout">Выход</a>
      </div>
    </div>
  </header>

  <main class="main">
    <h1 class="page-title"><?php echo $_smarty_tpl->getValue('title');?>
</h1>
    <div class="panel panel--compact">
      <?php if ($_smarty_tpl->getValue('seeded')) {?>
        <div class="card__meta">Сидинг выполнен</div>
      <?php }?>
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
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('categories'), 'category');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('category')->value) {
$foreach0DoElse = false;
?>
              <option value="<?php echo $_smarty_tpl->getValue('category')['id'];?>
"><?php echo $_smarty_tpl->getValue('category')['name'];?>
</option>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
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
<?php }
}
