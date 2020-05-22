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
            <h1 class="color264d7e titlesizemobile ">Devis</h1>
        </div>
        <div class="col-12 col-lg-6 mx-auto">
            <form>
                <fieldset class="border p-2 mb-2">
                    <legend class="color264d7e">Vos coordonnées</legend>
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
                </fieldset>
                <fieldset class="border p-2 mb-2">
                    <legend class="color264d7e">Adresse du chantier</legend>
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
                </fieldset>
                <fieldset class="border p-2 mb-2">
                    <legend class="color264d7e">Type de batiment</legend>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type-bat" id="house" value="house">
                        <label class="form-check-label" for="house">Maison</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type-bat" id="building" value="building">
                        <label class="form-check-label" for="building">Immeuble</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type-bat" id="factory" value="factory">
                        <label class="form-check-label" for="factory">Usine</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type-bat" id="industrialpremises" value="industrialpremises">
                        <label class="form-check-label" for="industrialpremises">Local industriel</label>
                    </div>
                </fieldset>
                <fieldset class="border p-2 mb-2">
                    <legend class="color264d7e">Information du chantier</legend>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="info" id="roofing" value="Couverture">
                        <label class="form-check-label" for="roofing">Couverture</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="info" id="roofermaintenance" value="Entretien">
                        <label class="form-check-label" for="roofermaintenance">Entretien</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="info" id="cheneau" value="Chéneau">
                        <label class="form-check-label" for="cheneau">Chéneau</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="info" id="externalinsulation" value="Isolation externe">
                        <label class="form-check-label" for="externalinsulation">Isolation externe</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="info" id="zincworks" value="Zinguerie">
                        <label class="form-check-label" for="zincworks">Zinguerie</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="info" id="gutter" value="Gouttière">
                        <label class="form-check-label" for="gutter">Gouttière</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="info" id="fireplace" value="Cheminée">
                        <label class="form-check-label" for="fireplace">Cheminée</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="info" id="roofwindow" value="Fenêtre de toit">
                        <label class="form-check-label" for="roofwindow">Fenêtre de toit</label>
                    </div>
                    <div class="form-row mt-2">
                        <div class="form-group col-lg-2">
                            <input type="text" class="form-control shadow-none" id="surface" placeholder="Surface en m²">
                        </div>
                        <div class="form-group col-lg-2">
                            <input type="text" class="form-control shadow-none" id="etage" placeholder="Nombre d'étage">
                        </div>
                    </div>
                </fieldset>
                <fieldset class="border p-2 mb-4">
                    <legend class="color264d7e">Photo de votre toiture</legend>
                    <div class="form-row mt-2">
                        <div class="form-group col-lg-4">
                            <label for="photo">Photo 1</label>
                            <input type="file" class="form-control-file shadow-none" id="photo" name="photo">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="photo">Photo 2</label>
                            <input type="file" class="form-control-file shadow-none" id="photo1" name="photo">
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="photo">Photo 3 (pignon)</label>
                            <input type="file" class="form-control-file shadow-none" id="photo3" name="photo">
                        </div>
                    </div>
                </fieldset>
                <div class="form-group">
                    <textarea class="form-control resize shadow-none" id="details" rows="5" placeholder="Information complémentaire"></textarea>
                </div>
                <div class="mx-auto d-flex justify-content-center">
                    <button type="submit" class="btn bg264d7efoot text-white mb-3">Envoyer</button>
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