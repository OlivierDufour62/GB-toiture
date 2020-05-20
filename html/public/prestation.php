<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.4.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/assets/css/main.css">
    <title>Prestations</title>
</head>

<body>
    <?php
    require_once('partial/header.php');
    ?>
    <main class="container-fluid p-0 m-0">
        <div class="col-12 p-0 m-0 position-relative">
            <img class="img-fluid col-12 p-0 m-0" src="../../public/assets/image/travaux.jpg" alt="">
            <div class="w80 pos-absolute-presta d-none d-lg-block">
                <h1 class="titlepresta">Couverture</h1>
            </div>
            <div class="col-12 d-lg-none text-center">
                <h2 class="h2sizemobile">Couverture</h>
            </div>
            <div class="w80 mx-auto d-lg-flex justify-content-center mt-4 d-none">
                <ul class="list-unstyled row">
                    <a class="text-dark" href="presta_tuile.php">
                        <li class="mr-4 fontsize">Tuile</li>
                    </a>
                    <a class="text-dark" href="presta_bac.php">
                        <li class="mr-4 fontsize">Bac-acier</li>
                    </a>
                    <a class="text-dark" href="presta_etanch.php">
                        <li class="mr-4 fontsize">Étanchéité</li>
                    </a>
                    <a class="text-dark" href="presta_new.php">
                        <li class="mr-4 fontsize">Neuve</li>
                    </a>
                    <a class="text-dark" href="presta_reno.php">
                        <li class="fontsize">Rénovation</li>
                    </a>
                </ul>
            </div>
            <div class="d-lg-none col-6 mx-auto">
                <select  class="custom-select" name="" id="">
                    <option value="1">Tuile</option>
                    <option value="1">Bac acier</option>
                    <option value="1">Étanchéité</option>
                    <option value="1">Neuve</option>
                    <option value="1">Rénovation</option>
                </select>
            </div>
        </div>
        <div class="col-12 mt-5 mb-3 w80 d-lg-flex mx-auto">
            <div class="col-12 col-lg-3 p-0 m-0 mr-4">
                <img class="w-100 img-fluid shadowed" src="../../public/assets/image/test1rogner.png" alt="">
            </div>
            <div class="col-12 col-lg-9 d-flex flex-column  p-0 m-0">
                <p class="fontsize">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor natus voluptatibus magnam laboriosam minus iste, possimus veniam sapiente quaerat saepe assumenda sunt laudantium eos quas reiciendis quam dolore beatae dignissimos!
                    Enim ab voluptas voluptate rerum fugit, accusamus cumque odio maiores error ad dolor ratione omnis nihil laborum culpa quam labore sunt explicabo impedit laboriosam corporis dignissimos. Saepe laboriosam qui obcaecati.
                    Quod, vitae a! Laudantium vel nostrum consequatur sapiente nulla reiciendis. Maxime soluta aperiam quo provident, accusamus officia nesciunt optio distinctio! Sunt, facere? Adipisci atque consequatur ipsam perspiciatis voluptas. Dicta, magnam?
                    Ipsa ipsum error modi maxime, sed voluptas iusto ipsam dolor tempora aut accusamus aperiam hic repudiandae tempore quisquam eligendi nemo, voluptatum non ab. Quibusdam laudantium voluptas similique. Dolorem, vitae dicta!
                    Impedit ipsum cum dolore ab. Error necessitatibus blanditiis non odio repellendus? Enim ipsum culpa dolores aliquid rerum suscipit quibusdam repudiandae id, quidem dolorem nesciunt magni, animi autem atque expedita omnis.</p>
                <p class="fontsize">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor natus voluptatibus magnam laboriosam minus iste, possimus veniam sapiente quaerat saepe assumenda sunt laudantium eos quas reiciendis quam dolore beatae dignissimos!
                    Enim ab voluptas voluptate rerum fugit, accusamus cumque odio maiores error ad dolor ratione omnis nihil laborum culpa quam labore sunt explicabo impedit laboriosam corporis dignissimos. Saepe laboriosam qui obcaecati.
                </p>
            </div>
        </div>
        <div class="col p-0 m-0 w80 mx-auto mb-3">
            <p class="fontsize">Quod, vitae a! Laudantium vel nostrum consequatur sapiente nulla reiciendis. Maxime soluta aperiam quo provident, accusamus officia nesciunt optio distinctio! Sunt, facere? Adipisci atque consequatur ipsam perspiciatis voluptas. Dicta, magnam?
                Ipsa ipsum error modi maxime, sed voluptas iusto ipsam dolor tempora aut accusamus aperiam hic repudiandae tempore quisquam eligendi nemo, voluptatum non ab. Quibusdam laudantium voluptas similique. Dolorem, vitae dicta!
                Impedit ipsum cum dolore ab. Error necessitatibus blanditiis non odio repellendus? Enim ipsum culpa dolores aliquid rerum suscipit quibusdam repudiandae id, quidem dolorem nesciunt magni, animi autem atque expedita omnis.</p>
        </div>
<div class="col-12 d-flex justify-content-center">
    <a href="devis.php" class="btn text-white bg264d7efoot mb-5 mx-auto">Demande de devis</a>
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