<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.4.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/assets/css/main.css">
    <title>Accueil</title>
</head>

<body>
    <?php
    require_once('partial/header.php');
    ?>
    <main class="container-fluid p-0 m-0">
        <div id="my-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li class="active" data-target="#my-carousel" data-slide-to="0" aria-current="location"></li>
                <li data-target="#my-carousel" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="img-fluid col-12 p-0" src="../../public/assets/image/travaux.jpg" alt="">
                </div>
                <div class="carousel-item">
                    <img class="img-fluid col-12 p-0" src="../../public/assets/image/travaux.jpg" alt="">
                </div>
            </div>
            <a class="carousel-control-prev" href="#my-carousel" data-slide="prev" role="button">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#my-carousel" data-slide="next" role="button">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="mt-2 text-center w100 w80 mx-auto">
            <h2 class="titlesizemobile titlecolor">GB Toiture, Professionnel de qualité</h2>
            <p class="fontsizemobile">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid facere optio doloribus consequatur deleniti, fugit eaque blanditiis at quod iste,</p>
            <p class="fontsizemobile">a nisi possimus ducimus cum minima ab. Laboriosam, totam excepturi?</p>
            <h3 class="subtitle subtitlemobile titlecolor">Découvrez nos domaines d'expertise</h3>
        </div>
        <div class="prestation col-12 mt-5 mb-5 w100 w80 mx-auto">
            <div class="row p-0 m-0 m-3">
                <div class="col-6 col-lg-3 position-relative anim">
                    <h4 class="subtitlemobile title-presta titlecolor mt-3">Couverture</h4>
                    <img class="w-100 img-fluid shadowed" src="../../public/assets/image/test1rogner.png" alt="">
                    <div class="d-none d-lg-block pos-absolute anim-opa zindex bg-opa">
                        <h4 class="title-presta text-danger">Couverture</h4>
                    </div>
                    <div class="d-none d-lg-block pos-abslolute5 anim-opa w-100 bg-opa h-100">
                        <p class="pos-absolute2 bold text-dark">Tuile,</p>
                        <p class="pos-absolute0 bold text-dark">Bac acier</p>
                        <p class="pos-absolute3 bold text-dark">Étanchéité</p>
                        <p class="pos-absolute1 bold text-dark">Neuve,</p>
                        <p class="pos-absolute6 bold text-dark">Rénovation</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3 position-relative anim">
                    <h4 class="subtitlemobile title-presta titlecolor mt-3">Entretien</h4>
                    <img class="w-100 img-fluid shadowed" src="../../public/assets/image/test1rogner.png" alt="">
                    <div class="d-none d-lg-block pos-absolute anim-opa zindex bg-opa">
                        <h4 class="title-presta text-danger">Entretien</h4>
                    </div>
                    <div class="d-none d-lg-block pos-abslolute5 anim-opa w-100 bg-opa h-100">
                        <p class="pos-absolute2 bold text-dark">Démousage,</p>
                        <p class="pos-absolute0 bold text-dark">Nettoyage Gouttère</p>
                        <p class="pos-absolute3 bold text-dark">Nettoyage Chéneau</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3 position-relative anim">
                    <h4 class="subtitlemobile title-presta titlecolor mt-3">Chéneau</h4>
                    <img class="w-100 img-fluid shadowed" src="../../public/assets/image/test1rogner.png" alt="">
                    <div class="d-none d-lg-block pos-absolute anim-opa zindex bg-opa">
                        <h4 class="title-presta text-danger">Chéneau</h4>
                    </div>
                    <div class="d-none d-lg-block pos-abslolute5 anim-opa w-100 bg-opa h-100">
                        <p class="pos-absolute2 bold text-dark">Création,</p>
                        <p class="pos-absolute0 bold text-dark">Remplacement</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3 position-relative anim">
                    <h4 class="subtitlemobile title-presta titlecolor mt-3">Isolation externe</h4>
                    <img class="w-100 img-fluid shadowed" src="../../public/assets/image/test1rogner.png" alt="">
                    <div class="d-none d-lg-block pos-absolute-titlespec anim-opa zindex bg-opa">
                        <h4 class="title-presta text-danger">Isolation externe</h4>
                    </div>
                    <div class="d-none d-lg-block pos-abslolute5 anim-opa w-100 bg-opa h-100">
                        <p class="pos-absolute2 bold text-dark">Externe</p>
                    </div>
                </div>
            </div>
            <div class="row p-0 m-0 m-3">
                <div class="col-6 col-lg-4 position-relative anim">
                    <h4 class="subtitlemobile title-presta titlecolor mt-3">Zinguerie</h4>
                    <img class="w-100 img-fluid shadowed" src="../../public/assets/image/test3.jpg" alt="">
                    <div class="d-none d-lg-block pos-absolute anim-opa zindex bg-opa">
                        <h4 class="title-presta text-danger">Zinguerie</h4>
                    </div>
                    <div class="d-none d-lg-block pos-abslolute5 anim-opa w-100 bg-opa h-100">
                        <p class="pos-absolute2 bold text-dark">Terasse</p>
                        <p class="pos-absolute0 bold text-dark">Chéneauu</p>
                        <p class="pos-absolute3 bold text-dark">Gouttière</p>
                        <p class="pos-absolute1 bold text-dark">Couvre mur</p>
                    </div>
                </div>
                <div class="col-6 col-lg-4 position-relative anim">
                    <h4 class="subtitlemobile title-presta titlecolor mt-3">Gouttière</h4>
                    <img class="w-100 img-fluid shadowed" src="../../public/assets/image/test3.jpg" alt="">
                    <div class="d-none d-lg-block pos-absolute anim-opa zindex bg-opa">
                        <h4 class="title-presta text-danger">Gouttière</h4>
                    </div>
                    <div class="d-none d-lg-block pos-abslolute5 anim-opa w-100 bg-opa h-100">
                        <p class="pos-absolute2 bold text-dark">Zinc</p>
                        <p class="pos-absolute0 bold text-dark">PVC</p>
                    </div>
                </div>
                <div class="col-6 col-lg-4 position-relative anim">
                    <h4 class="subtitlemobile title-presta titlecolor mt-3">Cheminée</h4>
                    <img class="w-100 img-fluid shadowed" src="../../public/assets/image/test3.jpg" alt="">
                    <div class="d-none d-lg-block pos-absolute anim-opa zindex bg-opa">
                        <h4 class="title-presta text-danger">Cheminée</h4>
                    </div>
                    <div class="d-none d-lg-block pos-abslolute5 anim-opa w-100 bg-opa h-100">
                        <p class="pos-absolute2 bold text-dark">Joint</p>
                        <p class="pos-absolute0 bold text-dark">Remplacement</p>
                    </div>
                </div>
                <div class="col-6 col-lg-4 position-relative anim">
                    <h4 class="subtitlemobile title-presta titlecolor mt-3">Fenêtre de toit</h4>
                    <img class="w-100 img-fluid shadowed" src="../../public/assets/image/test3.jpg" alt="">
                    <div class="d-none d-lg-block pos-absolute anim-opa zindex bg-opa">
                        <h4 class="title-presta text-danger">Fenêtre de toit</h4>
                    </div>
                    <div class="d-none d-lg-block pos-abslolute5 anim-opa w-100 bg-opa h-100">
                        <p class="pos-absolute2 bold text-dark">Création</p>
                        <p class="pos-absolute0 bold text-dark">Remplacement</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="realistion col-12 w100 w80 mx-auto mb-5">
            <div class="text-center mb-5">
                <h2 class="titlesizemobile titlecolor">Découvrez nos réalisations de tous nos domaines</h2>
            </div>
            <div class="row p-0 m-0 m-3">
                <div class="col-3">
                    <img class="w-100 img-fluid shadowed" src="../../public/assets/image/test1rogner.png" alt="">
                </div>
                <div class="col-3">
                    <img class="w-100 img-fluid shadowed" src="../../public/assets/image/test1rogner.png" alt="">
                </div>
                <div class="col-3">
                    <img class="w-100 img-fluid shadowed" src="../../public/assets/image/test1rogner.png" alt="">
                </div>
                <div class="col-3">
                    <img class="w-100 img-fluid shadowed" src="../../public/assets/image/test1rogner.png" alt="">
                </div>
            </div>
            <div class="row p-0 m-0 m-3">
                <div class="col-4">
                    <img class="w-100 img-fluid shadowed" src="../../public/assets/image/test3.jpg" alt="">
                </div>
                <div class="col-4">
                    <img class="w-100 img-fluid shadowed" src="../../public/assets/image/test3.jpg" alt="">
                </div>
                <div class="col-4">
                    <img class="w-100 img-fluid shadowed" src="../../public/assets/image/test3.jpg" alt="">
                </div>
            </div>
        </div>
    </main>
    <?php
    require_once('partial/footer.php');
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="../../public/assets/js/main.js"></script>
</body>

</html>