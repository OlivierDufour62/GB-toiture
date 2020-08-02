/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/main.scss';
import 'core-js/es/array';
import { setTimeout } from 'core-js';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

$(document).ready(function () {
    // $(`.mobilemenu`).click(function () {
    //     $(`.mm`).toggle(`fold`, 1500);
    // });

    $(`.mobilefoot`).click(function () {
        $(this).parent().parent().children('.footmobile').toggle('slow');
    });

    let path = window.location.pathname;
    $('#menu-public a').each(function () {
        let href = $(this).attr('href');
        if (path == '/' && href == '/' || path != '/' && href.indexOf(path) != -1) {
            $(this).parent().addClass('selected')
        }
    });

    $('#prestations .prestation').on('click', function(){
        var elem = $(this).addClass('clicked');
        setTimeout(function(){
            elem.removeClass('clicked')
        }, 5000)
    });

    $(".rb").one('change', function () {
        $(this).parent().parent().siblings('.div-none').removeClass('div-none');
    });

    $('.rb').click(function () {
        $('.service').parent().parent().addClass(this.value)
    })


    var headerAdmin = $('#header-admin');
    var headerPublic = $('#header-public');
    var header = headerAdmin.add(headerPublic).filter(':visible');
    var menuAdmin = $('#menu');
    var menuPublic = $('#menu-public');
    var menu = menuAdmin.add(menuPublic).filter(':visible');
    header.find('.hamburger').click(function () {
        // récupére la position de l'élément ciblé 
        var originalPosition = menu[0].getBoundingClientRect();
        // récupére le height de l'élément ciblé 
        var headerHeight = header.outerHeight();
        // console.log(originalPosition,'--',headerHeight);
        menu.data({
            // ici je stocke les données récupérées 
            originalPosition: originalPosition,
            maxWidth: menu.css('max-width')
        }).css({
            // ajoute a la variable menu des propriété css
            position: 'fixed',
            top: originalPosition.top,
            left: originalPosition.left
        });
        header.css({
            height: headerHeight
        });
        // ici c'est l'animation
        gsap.to(menu, {
            //durée d'ouverture du menu
            duration: .6,
            // position a gauche, droite, haut a 0 pour que le menu occupe la totalité de l'écran
            left: 0,
            maxWidth: 'none',
            right: 0,
            top: 0
        });
        //ajoute la propriété overflow a la nav
        menu.find('nav').height(0).css({
            overflow: 'hidden',
        });
        gsap.to(menu.find('nav'), {
            // durée d'affichage de la nav
            duration: .6,
            display: 'block',
            height: $(window).height() -  menu.children('img').height()
        });
        gsap.to(menu.children('i'), {
            //ici pour la croix de fermeture du menu
            opacity: 1,
            duration: 1.2
        });
    });
    // fermeture du menu 
    menu.children('i').click(function () {
        var originalPosition = menu.data('originalPosition');
        console.log(originalPosition)
        gsap.to(this, {
            opacity: 0,
            duration: .6
        });
        gsap.to(menu.find('nav'), {
            height: 0,
            duration: .5
        });
        gsap.to(menu, {
            duration: .2,
            left: originalPosition.left,
            right: 20,
            top: originalPosition.top,
            onComplete: function () {
                menu.css('max-width', menu.data('maxWidth'));
            }
        });
    });

    $('.addcat').click(function () {
        $('.div-none').toggle(`fold`, 1500);
    });

    $('#addcategory').on('click', function (e) {
        e.preventDefault();
        let data = {};
        $('.ajaxaddcategory')
            .serializeArray()
            .forEach((object) => {
                data[object.name] = object.value
            });
        $.ajax({
            type: 'POST',
            url: `/admin/prestation`,
            data: data,
            success: function (data) {
                if (data === true) {
                    $(".successsend").removeClass("d-none");
                    setTimeout(function () {
                        $(".successsend").addClass("d-none");
                    }, 1500);
                }
            }
        });
    });

    $('#addcustomer').on('click', function (e) {
        e.preventDefault();
        let data = {};
        $('.ajaxaddcustomer')
            .serializeArray()
            .forEach((object) => {
                data[object.name] = object.value
            });
        $.ajax({
            type: 'POST',
            url: `/admin/addcustomer`,
            data: data,
            success: function (data) {
                if (data === true) {
                    $(".successsend").removeClass("d-none");
                    setTimeout(function () {
                        $(".successsend").addClass("d-none");
                    }, 1500);
                }
            }
        });
    });

    $('#editcustomer').on('click', function (e) {
        e.preventDefault();
        let data = {};
        const id = $('.ajaxeditcustomer').attr('customerid');
        $('.ajaxeditcustomer')
            .serializeArray()
            .forEach((object) => {
                data[object.name] = object.value
            });
        $.ajax({
            type: 'POST',
            url: `/admin/editcustomer/${id}`,
            data: data,
            success: function (data) {
                if (data === true) {
                    $(".successsend").removeClass("d-none");
                    setTimeout(function () {
                        $(".successsend").addClass("d-none");
                    }, 1500);
                }
            }
        });
    });

    $('#addservice').on('click', function (e) {
        e.preventDefault();
        let data = {};
        $('.ajaxaddservice')
            .serializeArray()
            .forEach((object) => {
                data[object.name] = object.value
            });
        $.ajax({
            type: 'POST',
            url: `/admin/addservice`,
            data: data,
            success: function (data) {
                if (data === true) {
                    $(".successsend").removeClass("d-none");
                    setTimeout(function () {
                        $(".successsend").addClass("d-none");
                    }, 1500);
                }
            }
        });
    });

    $('#editservice').on('click', function (e) {
        e.preventDefault();
        let data = {};
        const id = $('.ajaxeditservice').attr('serviceid');
        $('.ajaxeditservice')
            .serializeArray()
            .forEach((object) => {
                data[object.name] = object.value
            });
        $.ajax({
            type: 'POST',
            url: `/admin/editservice/${id}`,
            data: data,
            success: function (data) {
                if (data === true) {
                    $(".successsend").removeClass("d-none");
                    setTimeout(function () {
                        $(".successsend").addClass("d-none");
                    }, 1500);
                }
            }
        });
    });

    $('#addconstruction').on('click', function (e) {
        e.preventDefault();
        let data2 = new FormData($('.ajaxaddconsctruction')[0]);
        // console.log(data2)
        $.ajax({
            type: 'POST',
            url: `/admin/addconstruction`,
            data: data2,
            contentType: false,
            processData: false,
            success: function (data, status) {
                console.log(status)
                console.log(data)
                $('input').val('');
                $('textarea').val('');
                $(".successsend").removeClass("d-none").addClass('bg-success').children().text('Chantier enregistré');
                setTimeout(function () {
                    $(".successsend").addClass("d-none").removeClass("bg-success");
                }, 1500);
            },
            error: function (err) {
                console.log(err);
                $(".successsend").removeClass("d-none").addClass('bg-danger').children().text(err.responseJSON);
                setTimeout(function () {
                    $(".successsend").addClass("d-none").removeClass("bg-danger");
                }, 1500);
            }
        });
    });

    $('#sendresponse').on('click', function (e) {
        e.preventDefault();
        let data = {};
        const id = $('.ajaxsendresponse').attr('responseid');
        $('.ajaxsendresponse')
            .serializeArray()
            .forEach((object) => {
                data[object.name] = object.value
            });
        $.ajax({
            type: 'POST',
            url: `/admin/replymessage/${id}`,
            data: data,
            success: function (data) {
                if (data === true) {
                    $(".successsend").removeClass("d-none");
                    setTimeout(function () {
                        $(".successsend").addClass("d-none");
                    }, 1500);
                }
            }
        });
    });



    $('#search').on('click', function (e) {
        e.preventDefault()
        let phonenumber = $('.searchbar').val()
        $.ajax({
            type: 'GET',
            url: `/admin/searchcustomer`,
            data: { phonenumber: phonenumber },
            success: function (data) {
                $('#construction_customer_lastname').val(data.lastname);
                $('#construction_customer_phonenumber').val(phonenumber);
                $('#construction_customer_addresOne').val(data.addresOne);
                $('#construction_customer_zipcode').val(data.zipcode);
                $('#construction_customer_city').val(data.city);
                $('#construction_name').val(data.lastname);
            }
        });
    });

    $('#search').on('click', function (e) {
        e.preventDefault()
        let phonenumber = $('.searchbar').val()
        $.ajax({
            type: 'GET',
            url: `/admin/searchcustomer`,
            data: { phonenumber: phonenumber },
            success: function (data) {
                $('#quote_client_lastname').val(data.lastname);
                $('#quote_client_firstname').val(data.firstname);
                $('#quote_client_phonenumber').val(phonenumber);
                $('#quote_client_email').val(data.email);
                $('#quote_client_addresOne').val(data.addresOne);
                $('#quote_client_zipcode').val(data.zipcode);
                $('#quote_client_city').val(data.city);
                $('#quote_name').val(data.lastname);
            }
        });
    });

    // partie isActive

    $('.messageswitches').on('change', function () {
        const id = $(this).attr('messageswitches');
        $('.messageswitches')
        $.ajax({
            url: `/admin/messageisactive/${id}`,
        }).done();
    });

    $('.customerswitches').on('change', function () {
        const id = $(this).attr('customerswitches');
        $('.customerswitches')
        $.ajax({
            url: `/admin/customerisactive/${id}`,
        }).done();
    });

    $('.categoryswitches').on('change', function () {
        const id = $(this).attr('categoryswitches');
        $('.categoryswitches')
        $.ajax({
            url: `/admin/categoryisactive/${id}`,
        }).done();
    });

    $('.serviceswitches').on('change', function () {
        const id = $(this).attr('serviceswitches');
        $('.serviceswitches')
        $.ajax({
            url: `/admin/serviceisactive/${id}`,
        }).done();
    });

    $('.galeryswitches').on('change', function () {
        const id = $(this).attr('galeryswitches');
        $('.galeryswitches')
        $.ajax({
            url: `/admin/pictureisgalery/${id}`,
        }).done();
    });

    $('.carrousselswitches').on('change', function () {
        const id = $(this).attr('carrousselswitches');
        $('.carrousselswitches')
        $.ajax({
            url: `/admin/pictureiscarroussel/${id}`,
        }).done();
    });

    $('.pictureswitches').on('change', function () {
        const id = $(this).attr('pictureswitches');
        $('.pictureswitches')
        $.ajax({
            url: `/admin/pictureisactive/${id}`,
        }).done();
    });

    // fin partie isActive

    var $categories = $('.categories');
    // When sport gets selected ...
    $categories.change(function () {
        // ... retrieve the corresponding form.
        var $form = $(this).closest('form');
        // Simulate form data, but only include the selected sport value.
        var data = {};
        data[$categories.attr('name')] = $(this).val();
        // Submit data via AJAX to the form's action path.
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: data,
            success: function (html) {
                // Replace current position field ...
                $('#document_service').replaceWith(
                    // ... with the returned one from the AJAX response.
                    $(html).find('#document_service')
                );
                // Position field now displays the appropriate positions.
            }
        });
    });

    $('#senddevis').on('click', function (e) {
        e.preventDefault();
        let data2 = new FormData($('.ajaxsenddevis')[0]);
        console.log(data2.values())
        // console.log($('#condition'))
        $('#form-error').hide();
        $.ajax({
            type: 'POST',
            url: `/devis`,
            data: data2,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.error) {
                    $('#form-error').html(data.error).show()
                    return;
                }
                $('input').val('');
                $('textarea').val('');
                alert('Votre demande a bien été envoyée');
            }
        },
        );
    });

    $(".flip1").click(function () {
        $(".panel1").slideToggle("slow");
    });

    $(".flip").click(function () {
        $(".panel2").slideToggle("slow");
    });

    var $collectionHolder;
    var $addTagButton = $('<button class="btn text-white btn264d7e add_tag_link mt-3">Ajouter un materiaux</button>');
    var $newLinkLi = $('<li class="col-12 d-flex justify-content-end p-0 m-0"></li>').append($addTagButton);
    $collectionHolder = $('ul.tags').addClass('list-unstyled p-0 m-0');
    // add the "add a tag" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);
    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find('input').length);
    $addTagButton.click(function (e) {
        // add a new tag form (see next code block)
        addTagForm($collectionHolder, $newLinkLi);
    });
    // setup an "add a tag" link
    function addTagForm($collectionHolder, $newLinkLi) {
        // Get the data-prototype explained earlier
        var prototype = $collectionHolder.data('prototype');
        // get the new index
        var index = $collectionHolder.data('index');
        var newForm = prototype;
        // You need this only if you didn't set 'label' => false in your tags field in TaskType
        // Replace '__name__label__' in the prototype's HTML to
        // instead be a number based on how many items we have
        // newForm = newForm.replace(/__name__label__/g, index);
        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        newForm = newForm.replace(/__name__/g, index);
        // increase the index with one for the next item
        $collectionHolder.data('index', index + 1).addClass('col-12', 'dflex');
        // Display the form in the page in an li, before the "Add a tag" link li
        var $newFormLi = $('<li></li>').append(newForm).children('div').addClass('dflex w100').children().addClass('col-lg-3 col-xl-3 m-0 p-0');
        $newLinkLi.before($newFormLi);
    }
    // création d'un variable vide
    var $collectionHolderSD;
    // variable contenant un bouton
    var $addTagButtonSD = $('<button id="presta" class="btn text-white btn264d7e mt-3 bpresta">Ajouter une prestation</button>');
    // variable contenant des balises li
    var $newLinkLiSD = $('<li class="col-12 d-flex justify-content-end p-0 m-0 bpresta"></li>').append($addTagButtonSD);
    // ici on ajouter des données à la variable $collectionHolderSD on lui d'ajouter des classes a l'ul contenant la classe tag
    $collectionHolderSD = $('ul.tag').addClass('list-unstyled p-0 m-0');
    // ici on lui de lui ajouter ce que contient la variable $newLinkLiSD
    $collectionHolderSD.append($newLinkLiSD);
    $collectionHolderSD.data('index', $collectionHolderSD.find('input').length);
    // ici on lui dit que quand on clique sur le bouton on lui les deux variables $collectionHolderSD, $newLinkLiSD
    $addTagButtonSD.click(function (e) {
        addTagForm($collectionHolderSD, $newLinkLiSD);
    });
    // ici la fonction permettant d'ajouter les champs et les cloner en indentant le l'indice de 1
    function addTagForm($collectionHolderSD, $newLinkLiSD) {
        var prototypeSD = $collectionHolderSD.data('prototype');
        var indexSD = $collectionHolderSD.data('index');
        var newFormSD = prototypeSD;
        newFormSD = newFormSD.replace(/__name__/g, indexSD);
        $collectionHolderSD.data('index', indexSD + 1).addClass('col-12 dflex');
        var $newFormLiSD = $('<li></li>').append(newFormSD).children('div').addClass('dflex flex-mobile noeud w100').children().addClass('col-lg-2 col-xl-2 m-0 p-0').parent().append('<br>');
        $newLinkLiSD.before($newFormLiSD);
    }

    // ici on indique que au clique du bouton #presta quelque chose doit se faire 
    $('#presta').click(function () {
        // variable contenant tout les selecte finissant par catégorie
        var category = $('select[name*="categorie"]');
        // ici on indique qu'il doit se passé quelque chose au changement du select
        category.change(function () {
            // ici je crée une variable pour ciblé le select appartenant au meme groupe que celui des catégorie
            var service = $(this).parent().parent().find('select[name*="designation"]');
            // console.log(service)
            // je crée uns constante contenant l'id de la catégorie afin de l'a passé a la route je l'a récupére avec la value du select catégorie
            const idcat = $(this).val();
            // on reattribu les données du formulaires dans data afin de les envoyer dans le corps de la requête ajax
            let data1 = {};
            // ajax commence ici 
            $.ajax({
                // la route du controller visé  on retrouve ici la constante
                url: `/admin/service/${idcat}`,
                // on définie la méthode du formulaire ici en get car c'est plus sécurisé pour récupérer des données
                type: 'GET',
                // les données du form
                data: data1,
                //ici je precise que se sera du JSON qu'on recevra
                dataType: 'json',
                success: function (html) {
                    //évite de réécrire le dom trop fréquemment de facon optimisé 
                    var fragment = document.createDocumentFragment();
                    $(html).each(function (index, e) {
                        $('<option>').val(e.id).html(e.name).appendTo(fragment);
                    });
                    service.html(fragment)
                }
            });
        });
    });

    $('#generate').on('click', function (e) {
        e.preventDefault();
        // on reattribu les données du formulaires dans data afin de les envoyer dans le corps de la requête ajax
        let data = {};
        // ici on récupère l'id de la demande de devis afin de pouvoir la mettre dans la route 
        const id = $('.ajaxgenerate').attr('treatmentid');
        // ici on parcours les données 
        $('.ajaxgenerate')
            .serializeArray()
            .forEach((object) => {
                data[object.name] = object.value
            });
        // ajax commence ici 
        console.log(data)
        $.ajax({
            // on définie la méthode du formulaire ici en post car c'est plus sécurisé pour transmettre des données
            type: 'POST',
            // la route du controller visé 
            url: `/admin/treatment/${id}`,
            // les données du form
            data: data,
            // et enfin le succés 
            success: function (data) {
                if (data) {
                    $(".successsend").removeClass("d-none");
                    setTimeout(function () {
                        $(".successsend").addClass("d-none");
                    }, 1500);
                    $.ajax({
                        url: `/admin/generatepdf/` + data.id,
                    }).done();
                }
            }
        });
    });

    $('#create').on('click', function (e) {
        e.preventDefault();
        // on reattribu les données du formulaires dans data afin de les envoyer dans le corps de la requête ajax
        let data = {};
        // ici on récupère l'id de la demande de devis afin de pouvoir la mettre dans la route 
        const id2 = $('#sendquote').attr('id')
        // ici on parcours les données 
        $('.ajaxcreate')
            .serializeArray()
            .forEach((object) => {
                data[object.name] = object.value
            });
        // ajax commence ici 
        $.ajax({
            // on définie la méthode du formulaire ici en post car c'est plus sécurisé pour transmettre des données
            type: 'POST',
            // la route du controller visé 
            url: `/admin/createdocument`,
            // les données du form
            data: data,
            // et enfin le succés 
            success: function (data) {
                console.log(data.id)
                if (data) {
                    $(".successsend").removeClass("d-none");
                    setTimeout(function () {
                        $(".successsend").addClass("d-none");
                    }, 1500);
                }
                $.ajax({
                    url: `/admin/generatepdf/` + data.id,
                }).done();
            }
        });
    });

    $('#sendquote').on('click', function (e) {
        e.preventDefault();

    });
});                                                                                                                      