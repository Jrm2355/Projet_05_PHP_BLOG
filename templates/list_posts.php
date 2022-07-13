<?php $title = "Liste articles"; ?>

<?php ob_start(); ?>
<!-- Page Header-->
<header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>Listes des articles</h1>
                </div>
            </div>
        </div>
    </div>
</header>

<?php
foreach ($posts as $post) {
?>
    <div class="container px-4 px-lg-5">
        <a href="index.php?action=post&id=<?= urlencode($post->identifier) ?>"><h2><?= htmlspecialchars($post->title) ?></h2></a>
        <p> <?= htmlspecialchars($post->chapo) ?> </p>
        <em>le <?= $post->frenchCreationDate; ?></em>
</br>
</br>
    </div>
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
