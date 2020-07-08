$(document).ready(function () {
    $(`.mobilemenu`).click(function () {
        $(`.mm`).toggle(`fold`, 1500);
    });

    $(`.mobilefoot`).click(function () {
        $(this).parent().parent().children('.footmobile').toggle('slow');
    });

    $(`.hov`).hover(function () {
        $(this).addClass(`border264d7e`);
    }, function () {
        $(this).removeClass(`border264d7e`);
    });


    let path = window.location.pathname.split('8000');
    $('.cc').each(function () {
        $(this).children().removeClass('border....')
        $('.cc').each(function () {
            if ($(this).attr('href') == path[path.length - 1]) {
                $(this).children().addClass('border264d7efixe');
            }
        });
    });

    $(".rb").click(function () {
        var div = $("." + this.value);
        $('.div-hide').hide('slow');
        div.show("slow");
    });

    $('.rb').click(function () {
        $('.service').parent().parent().addClass(this.value)
    })

    $("#header-admin .hamburger").click(function () {
        // récupére la position de l'élément ciblé 
        var originalPosition = $('#menu')[0].getBoundingClientRect();
        // récupére le height de l'élément ciblé 
        var headerHeight = $('#header-admin').outerHeight();
        // ajoute a #menu des propriété css
        $('#menu').data({
            originalPosition: originalPosition,
            maxWidth: $('#menu').css('max-width')
        }).css({
            position: 'fixed',
            top: originalPosition.top,
            left: originalPosition.left
        });
        $('#header-admin').css({
            height: headerHeight
        });
        gsap.to('#menu', {
            duration: .6,
            left: 0,
            maxWidth: 'none',
            right: 0,
            top: 0
        });
        $('#menu nav').height(0).css({
            overflow: 'hidden',
        });
        gsap.to(`#menu nav`, {
            duration: .6,
            display: 'block',
            height: $(window).height() - $('#menu>img').height()
        });
        gsap.to('#menu > i', {
            opacity: 1,
            duration: 1.2
        });
    });
    // fermeture du menu 
    $(`#menu > i`).click(function () {
        var originalPosition = $('#menu').data('originalPosition');
        console.log(originalPosition)
        gsap.to('#menu > i', {
            opacity: 0,
            duration: .6
        });
        gsap.to(`#menu nav`, {
            height: 0,
            duration: .5
        });
        gsap.to('#menu', {
            duration: .2,
            left: originalPosition.left,
            right: 20,
            top: originalPosition.top,
            onComplete: function () {
                $('#menu').css('max-width', $('#menu').data('maxWidth'));
            }
        }); 
    })



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
        // console.log(data2)
        $.ajax({
            type: 'POST',
            url: `/devis`,
            data: data2,
            contentType: false,
            processData: false,
            success: function (data) {
                $('input').val('');
                $('textarea').val('');
                $(".successsend").removeClass("d-none");
                setTimeout(function () {
                    $(".successsend").addClass("d-none");
                }, 1500);
            },
            error: function (err) {
                console.log(err);
            }
        });
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
        var $newFormLi = $('<li></li>').append(newForm).children('div').addClass('dflex').children().addClass('col-6 col-lg-3 col-xl-3 m-0 p-0');
        $newLinkLi.before($newFormLi);
    }

    var $collectionHolderSD;
    var $addTagButtonSD = $('<button id="presta" class="btn text-white btn264d7e mt-3 bpresta">Ajouter une prestation</button>');
    var $newLinkLiSD = $('<li class="col-12 d-flex justify-content-end p-0 m-0 bpresta"></li>').append($addTagButtonSD);

    $collectionHolderSD = $('ul.tag').addClass('list-unstyled p-0 m-0');
    $collectionHolderSD.append($newLinkLiSD);
    $collectionHolderSD.data('index', $collectionHolderSD.find('input').length);
    $addTagButtonSD.click(function (e) {
        addTagForm($collectionHolderSD, $newLinkLiSD);
    });

    function addTagForm($collectionHolderSD, $newLinkLiSD) {
        var prototypeSD = $collectionHolderSD.data('prototype');
        var indexSD = $collectionHolderSD.data('index');
        var newFormSD = prototypeSD;
        newFormSD = newFormSD.replace(/__name__/g, indexSD);
        $collectionHolderSD.data('index', indexSD + 1).addClass('col-12', 'dflex');
        var $newFormLiSD = $('<li></li>').append(newFormSD).children('div').addClass('dflex noeud').children().addClass('col-6 col-lg-2 col-xl-2 m-0 p-0').parent().append('<br>');
        $newLinkLiSD.before($newFormLiSD);
    }

    $('#presta').click(function () {
        var category = $('select[name*="categorie"]');
        category.change(function () {
            var service = $(this).parent().parent().find('select[name*="designation"]');
            console.log(service)
            const idcat = $(this).val();
            console.log(idcat)
            let data1 = {};
            $.ajax({
                url: `/admin/service/${idcat}`,
                type: 'GET',
                data: data1,
                dataType: 'json',
                success: function (html) {
                    // service.html('')
                    // $(html).each(function (index, e) {
                    //     console.log(html)
                    //     service.append('<option value='+e.id+'>' + e.name + '</option>');
                    // });
                    // //évite de réécrire le dom trop fréquemment de facon moins optimisé 
                    // var buffer = [];
                    // $(html).each(function (index, e) {
                    //     buffer.push('<option value='+e.id+'>' + e.name + '</option>');
                    // });
                    // service.html(buffer.join(''));

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

    // $('#generate').on('click', function (e) {
    //     e.preventDefault();
    //     let data = {};
    //     const id = $('.ajaxgenerate').attr('treatmentid');
    //     $('.ajaxgenerate')
    //         .serializeArray()
    //         .forEach((object) => {
    //             data[object.name] = object.value
    //         });
    //     $.ajax({
    //         type: 'POST',
    //         url: `/admin/treatment/${id}`,
    //         data: data,
    //         success: function (data) {
    //             if (data === true) {
    //                 $(".successsend").removeClass("d-none");
    //                 setTimeout(function () {
    //                     $(".successsend").addClass("d-none");
    //                 }, 1500);
    //             }
    //         }
    //     });
    // });
});                                                                                                                      