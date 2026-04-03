<?php
/* Smarty version 5.8.0, created on 2026-04-03 21:04:17
  from 'file:category.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d02b51001f03_38998986',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b2aa1c9bdd138663c92c2bc19d93a4fa2339d489' => 
    array (
      0 => 'category.tpl',
      1 => 1775250145,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69d02b51001f03_38998986 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = '/var/www/html/templates';
?><!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $_smarty_tpl->getValue('category')['name'];?>
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
    <h1 class="page-title"><?php echo $_smarty_tpl->getValue('category')['name'];?>
</h1>
    <p class="section__description"><?php echo (($tmp = $_smarty_tpl->getValue('category')['description'] ?? null)===null||$tmp==='' ? '-' ?? null : $tmp);?>
</p>

    <div class="tools">
      <div class="sort">
        <span class="sort__label">Сортировка:</span>
        <a class="btn btn--dark" href="/?action=category&id=<?php echo $_smarty_tpl->getValue('categoryId');?>
&sort=date&page=1">По дате</a>
        <a class="btn btn--dark" href="/?action=category&id=<?php echo $_smarty_tpl->getValue('categoryId');?>
&sort=views&page=1">По просмотрам</a>
      </div>
    </div>

    <div class="cards">
      <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('articles'), 'article');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('article')->value) {
$foreach0DoElse = false;
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
          <div class="card__meta">Просмотры: <?php echo $_smarty_tpl->getValue('article')['views_count'];?>
</div>
          <a class="btn btn--link" href="/?action=article&id=<?php echo $_smarty_tpl->getValue('article')['id'];?>
">Continue Reading</a>
        </article>
      <?php
}
if ($foreach0DoElse) {
?>
        <div class="empty">Статей в категории нет</div>
      <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </div>

    <div class="pagination">
      <?php if ($_smarty_tpl->getValue('page') > 1) {?>
        <a class="btn btn--dark" href="/?action=category&id=<?php echo $_smarty_tpl->getValue('categoryId');?>
&sort=<?php echo $_smarty_tpl->getValue('sort');?>
&page=<?php echo $_smarty_tpl->getValue('page')-1;?>
">Назад</a>
      <?php }?>
      <span class="pagination__text">Страница <?php echo $_smarty_tpl->getValue('page');?>
 из <?php echo $_smarty_tpl->getValue('totalPages');?>
</span>
      <?php if ($_smarty_tpl->getValue('page') < $_smarty_tpl->getValue('totalPages')) {?>
        <a class="btn btn--dark" href="/?action=category&id=<?php echo $_smarty_tpl->getValue('categoryId');?>
&sort=<?php echo $_smarty_tpl->getValue('sort');?>
&page=<?php echo $_smarty_tpl->getValue('page')+1;?>
">Вперед</a>
      <?php }?>
    </div>
  </main>

  <footer class="footer">
    <div class="footer__inner">Copyright 2026. All Rights Reserved</div>
  </footer>
</body>
</html>
<?php }
}
