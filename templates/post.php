<?php $title = "Le blog de l'AVBN"; ?>

<?php ob_start(); ?>
<!-- Page Header-->
<header class="masthead" style="background-image: url('assets/img/post-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1 class="post-title"> <?= htmlspecialchars($post->title) ?> </h1>
                    <p> <?= htmlspecialchars($post->chapo) ?> </p>
                    <em>le <?= $post->frenchCreationDate ?></em>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Post Content-->
<div class="container px-4 px-lg-5">
    <p><a href="index.php?action=listPosts">Retour à la liste des billets</a></p>
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p><?= nl2br(htmlspecialchars($post->content)) ?>
                <?= htmlspecialchars($post->chapo) ?>
                </p>
                <em>le <?= $post->frenchCreationDate ?></em>
            </div>
        </div>
    </div>
</div>
<br>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
