<?php $title = "Ajout d'article"; ?>

<?php ob_start(); ?>
<!-- Page Header-->
<header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>Ajout d'article</h1>
                </div>
            </div>
        </div>
    </div>
</header>

<main>
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <form action="index.php?action=addPost" method="post">
                    <div>
                        <h4>Titre</h4>
                        <input class="form-control" type="text" id="title" name="title"/>
                    </div>
                    </br>
                    <div>
                        <h4>Chapo</h4>
                        <input class="form-control" type="text" id="chapo" name="chapo"/>
                    </div>
                    </br>
                    <div>
                        <h4>Contenu</h4>
                        <textarea class="form-control" id="content" name="content"></textarea>
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
