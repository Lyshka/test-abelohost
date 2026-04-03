<?php
/* Smarty version 5.8.0, created on 2026-04-03 21:04:17
  from 'file:index.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d02b514bd421_75867395',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '94ad261647aa7bfeb6835379e098cb3d84cfcba3' => 
    array (
      0 => 'index.tpl',
      1 => 1775250110,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69d02b514bd421_75867395 (\Smarty\Template $_smarty_tpl) {
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
        <?php if ($_smarty_tpl->getValue('isAdmin')) {?>
          <a class="btn" href="/?action=admin">Админка</a>
          <a class="btn" href="/?action=admin-logout">Выход</a>
        <?php } else { ?>
          <a class="btn" href="/?action=admin">Вход в админку</a>
        <?php }?>
      </div>
    </div>
  </header>

  <main class="main">
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('categories'), 'category');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('category')->value) {
$foreach0DoElse = false;
?>
      <section class="section">
        <div class="section__head">
          <h2 class="section__title"><?php echo $_smarty_tpl->getValue('category')['name'];?>
</h2>
          <a class="btn btn--link" href="/?action=category&id=<?php echo $_smarty_tpl->getValue('category')['id'];?>
">View All</a>
        </div>
        <p class="section__description"><?php echo (($tmp = $_smarty_tpl->getValue('category')['description'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>
</p>
        <div class="cards">
          <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('category')['articles'], 'article');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('article')->value) {
$foreach1DoElse = false;
?>
            <article class="card">
              <?php if ($_smarty_tpl->getValue('article')['image']) {?>
                <img class="card__image" src="<?php echo $_smarty_tpl->getValue('article')['image'];?>
" alt="<?php echo $_smarty_tpl->getValue('article')['title'];?>
">
              <?php }?>
              <h3 class="card__title"><a href="/?action=article&id=<?php echo $_smarty_tpl->getValue('article')['id'];?>
"><?php echo $_smarty_tpl->getValue('article')['title'];?>
</a></h3>
              <div class="card__meta"><?php echo $_smarty_tpl->getValue('article')['created_at'];?>
</div>
              <p class="card__text"><?php echo (($tmp = $_smarty_tpl->getValue('article')['description'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</p>
              <a class="btn btn--link" href="/?action=article&id=<?php echo $_smarty_tpl->getValue('article')['id'];?>
">Continue Reading</a>
            </article>
          <?php
}
if ($foreach1DoElse) {
?>
            <div class="empty">В этой категории пока нет статей</div>
          <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </div>
      </section>
    <?php
}
if ($foreach0DoElse) {
?>
      <div class="empty">Категорий со статьями пока нет</div>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
  </main>

  <footer class="footer">
    <div class="footer__inner">Copyright 2026. All Rights Reserved</div>
  </footer>
</body>
</html>
<?php }
}
