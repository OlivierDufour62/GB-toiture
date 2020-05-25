<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.4.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/assets/css/main.css">
    <title>Title</title>
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
                <a href="index.php"><img class="col-12 img-fluid" src="../../public/assets/image/logo/SmallLogo.png" alt=""></a>
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
            <div class="col-8 mt-5 mx-auto">
                <div class="table-responsive">
                    <table class="table table-striped table-dark text-center">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Email</th>
                                <th scope="col">Téléphone</th>
                                <th scope="col">Éditer</th>
                                <th scope="col">Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Laslaa</td>
                                <td>Mohammed</td>
                                <td>mohamedlaslaa@gmail.com</td>
                                <td>0606060606</td>
                                <td><i class="ri-arrow-right-line"></i></td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input providerswitches" clientswitches="{{provider.id}}" id="customSwitches{{client.id}}" {% if provider.isActive %} checked {% endif %}>
                                        <label class="custom-control-label" for="customSwitches{{client.id}}"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Devise</td>
                                <td>Théo</td>
                                <td>t.devise@laposte.net</td>
                                <td>0606060606</td>
                                <td><i class="ri-arrow-right-line"></i></td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input providerswitches" clientswitches="{{provider.id}}" id="customSwitches{{client.id}}" {% if provider.isActive %} checked {% endif %}>
                                        <label class="custom-control-label" for="customSwitches{{client.id}}"></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Dufour</td>
                                <td>Olivier</td>
                                <td>djpillz@hotmail.fr</td>
                                <td>0695281303</td>
                                <td><i class="ri-arrow-right-line"></i></td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input providerswitches" clientswitches="{{provider.id}}" id="customSwitches{{client.id}}" {% if provider.isActive %} checked {% endif %}>
                                        <label class="custom-control-label" for="customSwitches{{client.id}}"></label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-lg-flex justify-content-end">
                    <a class="btn text-white btn264d7e" href="add-customer.php">Ajouter un client</a>
                </div>
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