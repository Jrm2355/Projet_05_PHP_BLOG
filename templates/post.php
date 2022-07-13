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
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <h2>Commentaires</h2>
            <form action="index.php?action=addComment&id=<?= $post->identifier ?>" method="post">
            <div>
                <label for="author">Nom</label><br />
                <input class="form-control" type="text" id="author" name="author" />
            </div>
            <div>
                <label for="comment">Commentaire</label><br />
                <textarea class="form-control" id="comment" name="comment"></textarea>
            </div>
            <div>
                <input class="btn btn-primary text-uppercase" type="submit" />
            </div>
            </form>

            <?php
            foreach ($comments as $comment) {
                if ($comment->status == 1){               
            ?>
                    <p><strong><?= htmlspecialchars($comment->author) ?></strong> le <?= $comment->frenchCreationDate ?></p>
                    <p><?= nl2br(htmlspecialchars($comment->comment)) ?></p>
            <?php 
                }
            }
            ?>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
