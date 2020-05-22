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
        <div class="col-6 col-lg-2 mx-auto text-center mt-3 mb-3">
            <h1 class="color264d7e titlesizemobile">Contactez-nous</h1>
        </div>
        <div class="col-12 col-lg-6 mx-auto">
            <form>
                <div class="form-row">
                    <div class="form-group col-6 col-lg-6">
                        <input type="text" class="form-control shadow-none" id="lastname" placeholder="Nom">
                    </div>
                    <div class="form-group col-6 col-lg-6">
                        <input type="text" class="form-control shadow-none" id="firstname" placeholder="Prénom">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6 col-lg-6">
                        <input type="email" class="form-control shadow-none" id="lastname" placeholder="Email">
                    </div>
                    <div class="form-group col-6 col-lg-6">
                        <input type="text" class="form-control shadow-none" id="phonenumber" placeholder="Téléphone">
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control shadow-none" id="address" placeholder="Adresse">
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-2">
                        <input type="text" class="form-control shadow-none" id="zipcode" placeholder="Code postal">
                    </div>
                    <div class="form-group col-lg-10">
                        <input type="text" class="form-control shadow-none" id="city" placeholder="Ville">
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control shadow-none" id="address2" placeholder="Adresse secondaire">
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-2">
                        <input type="text" class="form-control shadow-none" id="zipcode2" placeholder="Code postal 2">
                    </div>
                    <div class="form-group col-lg-10">
                        <input type="text" class="form-control shadow-none" id="city2" placeholder="Ville 2">
                    </div>
                </div>
                <div class="form-group">
                    <textarea class="form-control resize shadow-none" id="exampleFormControlTextarea1" rows="5"></textarea>
                </div>
                <div class="mx-auto d-flex justify-content-center">
                    <button type="submit" class="btn bg264d7efoot text-white mb-3 shadow-none">Envoyer</button>
                </div>
            </form>
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