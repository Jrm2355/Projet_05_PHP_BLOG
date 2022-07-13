<?php $title = "Inscription"; ?>

<?php ob_start(); ?>
<!-- Page Header-->
<header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>Inscription</h1>
                </div>
            </div>
        </div>
    </div>
</header>

<main>
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <form action="index.php?action=inscription" method="post">
                    <div>
                        <p>Email</p>
                        <input class="form-control" type="text" id="email" name="email"/>
                    </div>
                    </br>
                    <div>
                        <p>Pseudo</p>
                        <input class="form-control" type="text" id="username" name="username"/>
                    </div>
                    </br>
                    <div>
                        <p>Mot de passe</p>
                        <input class="form-control" id="mdp" name="mdp"/>
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
