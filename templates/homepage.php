<?php $title = "Accueil Projet 05"; ?>

<?php ob_start(); ?>
<!-- Page Header-->
<header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                <img class="figure-img" src="assets/img/jeremyon.png">
                </div>
            </div>
        </div>
    </div>
</header>
<main >
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p>Contactez moi à l'aide du formulaire ci-dessous !</p>
                <div class="my-5">
                    <form action="index.php?action=mailer" method="post" id="contactForm" data-sb-form-api-token="API_TOKEN">
                        <div class="form-floating">
                            <input class="form-control" id="name" name="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                            <label for="name">Nom</label>
                            <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                        </div>
                        <div class="form-floating">
                            <input class="form-control" id="email" name="email" type="email" placeholder="Enter your email..." data-sb-validations="required,email" />
                            <label for="email">Courriel</label>
                            <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" id="message" name="message" placeholder="Enter your message here..." style="height: 12rem" data-sb-validations="required"></textarea>
                            <label for="message">Message</label>
                            <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                        </div>
                        <br />
                        <!-- Submit Button-->
                        <button class="btn btn-primary text-uppercase " id="submitButton" type="submit">Envoyer</button>
                    </form>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <p> Vous pouvez télécharger mon cv : <a href="assets/jyon.pdf" download><button class="btn btn-primary">télécharger </button></p></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>
