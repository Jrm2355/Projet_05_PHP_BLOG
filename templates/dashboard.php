<?php $title = "Dashboard"; ?>

<?php ob_start(); ?>
<!-- Page Header-->
<header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>Dashboard</h1>
                    <span class="subheading">Panneau de configuration</span>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <a href="index.php?action=addPost"><button class="btn btn-primary">Ajout d'article</button></a>
        </div>
        <hr class="my-4" />
    </div>
</div>

<div class="container position-relative px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <h2>Les articles</h2>
            <div class="my-5">
        </div>
    </div>    
</div>
<?php
foreach ($posts as $post) {
?>
    <div class="container px-4 px-lg-5">
            <h5>
                <?= htmlspecialchars($post->title); ?> 
                <a href="index.php?action=updatePost&id=<?= urlencode($post->identifier) ?>"><button class="btn btn-primary">Modifier </button></a> 
                <a href="index.php?action=deletePost&id=<?= urlencode($post->identifier) ?>"><button class="btn btn-primary">Supprimer </button></a> 
            </h5>
            <?php
            foreach ($comments as $comment) {
                if ($comment->post == $post->identifier && $comment->status == 0){ ?>
                    <div class="container px-4 px-lg-5">
                       <p> <?= htmlspecialchars($comment->comment) ?> <a href="index.php?action=validationComment&id=<?= urlencode($comment->identifier) ?>"><button class="btn btn-primary">Valider </button></a> </p>
                    </div>
                <?php }         
            }
            ?>
        <hr class="my-4" />
    </div>
<?php
}
?>



<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
