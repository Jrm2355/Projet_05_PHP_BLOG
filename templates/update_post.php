<?php $title = "Accueil Projet 05"; ?>

<?php ob_start(); ?>
<!-- Page Header-->
<header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>edit article</h1>
                </div>
            </div>
        </div>
    </div>
</header>
<main>
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <h2>Modification de l'article</h2>
                <form action="index.php?action=updatePost&id=<?= $post->identifier ?>" method="post">
                    <div>
                        <input class="form-control" type="text" id="title" name="title" value="<?= htmlspecialchars($post->title) ?>"/>
                    </div>
                    </br>
                    <div>
                        <input class="form-control" type="text" id="chapo" name="chapo" value="<?= htmlspecialchars($post->chapo) ?>"/>
                    </div>
                    </br>
                    <div>
                        <textarea class="form-control" id="content" name="content"><?= htmlspecialchars($post->content) ?></textarea>
                    </div>
                    </br>
                    <div>
                        <input class="btn btn-primary text-uppercase" type="submit" />
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>               
</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
