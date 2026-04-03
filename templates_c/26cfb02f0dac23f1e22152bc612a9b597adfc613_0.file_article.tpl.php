<?php
/* Smarty version 5.8.0, created on 2026-04-03 21:04:17
  from 'file:article.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d02b5107dfe5_16897770',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '26cfb02f0dac23f1e22152bc612a9b597adfc613' => 
    array (
      0 => 'article.tpl',
      1 => 1775250240,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69d02b5107dfe5_16897770 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/var/www/html/templates';
?><!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $_smarty_tpl->getValue('article')['title'];?>
</title>
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
      <h1 class="article__title"><?php echo $_smarty_tpl->getValue('article')['title'];?>
</h1>
      <?php if ($_smarty_tpl->getValue('article')['image']) {?>
        <img class="article__image" src="<?php echo $_smarty_tpl->getValue('article')['image'];?>
" alt="<?php echo $_smarty_tpl->getValue('article')['title'];?>
">
      <?php }?>
      <p class="card__text"><?php echo (($tmp = $_smarty_tpl->getValue('article')['description'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</p>
      <div class="article__meta">
        Просмотры: <?php echo $_smarty_tpl->getValue('article')['views_count'];?>

        |
        Дата публикации: <?php echo $_smarty_tpl->getValue('article')['created_at'];?>

        |
        Категории:
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('article')['categories'], 'category', true);
$_smarty_tpl->getVariable('category')->iteration = 0;
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('category')->value) {
$foreach0DoElse = false;
$_smarty_tpl->getVariable('category')->iteration++;
$_smarty_tpl->getVariable('category')->last = $_smarty_tpl->getVariable('category')->iteration === $_smarty_tpl->getVariable('category')->total;
$foreach0Backup = clone $_smarty_tpl->getVariable('category');
?>
          <?php echo $_smarty_tpl->getValue('category')['name'];
if (!$_smarty_tpl->getVariable('category')->last) {?>, <?php }?>
        <?php
$_smarty_tpl->setVariable('category', $foreach0Backup);
}
if ($foreach0DoElse) {
?>
          -
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      </div>
      <div class="article__body"><?php echo $_smarty_tpl->getValue('article')['body'];?>
</div>
    </article>

    <section class="section">
      <div class="section__head">
        <h2 class="section__title">Похожие статьи</h2>
      </div>
      <div class="cards">
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('similarArticles'), 'item');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('item')->value) {
$foreach1DoElse = false;
?>
          <article class="card">
            <?php if ($_smarty_tpl->getValue('item')['image']) {?>
              <img class="card__image" src="<?php echo $_smarty_tpl->getValue('item')['image'];?>
" alt="<?php echo $_smarty_tpl->getValue('item')['title'];?>
">
            <?php }?>
            <h3 class="card__title"><a href="/?action=article&id=<?php echo $_smarty_tpl->getValue('item')['id'];?>
"><?php echo $_smarty_tpl->getValue('item')['title'];?>
</a></h3>
            <div class="card__meta"><?php echo $_smarty_tpl->getValue('item')['created_at'];?>
</div>
            <p class="card__text"><?php echo (($tmp = $_smarty_tpl->getValue('item')['description'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</p>
            <a class="btn btn--link" href="/?action=article&id=<?php echo $_smarty_tpl->getValue('item')['id'];?>
">Continue Reading</a>
          </article>
        <?php
}
if ($foreach1DoElse) {
?>
          <div class="empty">Похожих статей нет</div>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      </div>
    </section>
  </main>

  <footer class="footer">
    <div class="footer__inner">Copyright 2026. All Rights Reserved</div>
  </footer>
</body>
</html>
<?php }
}
