<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.4.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/assets/css/main.css">
    <title>Ajout de photo</title>
</head>

<body>
    <header class="container-fluid mx-auto p-0 m-0 sticky-top bg-white">
        <div class="col-12 d-flex bg264d7efoot">
            <div class="col-6 mt-4 d-lg-none mobilemenuadmin d-flex flex-column justify-content-center text-center">
                <div class="hamb mb-2"></div>
                <div class="hamb mb-2"></div>
                <div class="hamb"></div>
            </div>
            <div class="col-6 col-lg-2 mt-2 mt-lg-3 d-flex justify-content-end">
                <img class="col-12 img-fluid" src="../../public/assets/image/logo/SmallLogo.png" alt="">
            </div>
            <div class="col-lg-8 d-lg-flex align-items-center justify-content-center d-none">
                <h1 class="text-white text-center">GB-Toiture</h1>
            </div>
        </div>
    </header>
    <main class="container-fluid p-0 m-0">
        <div class="col-12 row p-0 m-0">
            <?php
            require('partial/menu.php');
            ?>
            <div class="col-10 mt-5">
            <form class="col-6 mx-auto">
                    <div class="form-row">
                        <div class="form-group col-6 col-lg-6">
                            <input type="text" class="form-control shadow-none" id="lastname" placeholder="Nom du chantier">
                        </div>
                        <div class="form-group col-6 col-lg-6">
                            <input type="file" class="form-control-file shadow-none" id="image">
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
                    <div class="mx-auto d-flex justify-content-center">
                        <button type="submit" class="btn bg264d7efoot text-white mb-3 shadow-none">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="../../public/assets/js/main.js"></script>
</body>

</html>