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

    //animate for index prestation and galery
    $('.anim').mouseenter(function () {
        $(this).children('.anim-opa').css('animation-name', 'prestation');
        $(this).children('.bg-opa').css('animation-name', 'prestationbg');
    });
    $('.anim').mouseleave(function () {
        $(this).children('.anim-opa').css('animation-name', 'prestationleave');
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

    $(".mobilemenuadmin").click(function () {
        $(`.mm-admin`).addClass('m-admin');
        $(`.mm-admin`).toggle(`fold`, 1500);
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
        console.log(data2)
        $.ajax({
            type: 'POST',
            url: `/admin/addconstruction`,
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

    // $('.reply').on('click', function (e) {
    //     e.preventDefault();
    //     let data = {};
    //     const id = $('.reply').attr('id');
    //     // $('.ajaxaddservice')
    //     //     .serializeArray()
    //     //     .forEach((object) => {
    //     //         data[object.name] = object.value
    //     //     });
    //     $.ajax({
    //         type: 'POST',
    //         url: `/admin/response/${id}`,
    //         data: data,
    //         success: function (data) {
    //             $('.response').removeClass('d-none')
    //             $(".response").html(data);
    //         },
    //     });
    // });

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
        console.log(data2)
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

    $(".flip1").click(function() {
        $(".panel1").slideToggle("slow");
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
        $collectionHolder.data('index', index + 1).addClass('col-12' ,'dflex');
        // Display the form in the page in an li, before the "Add a tag" link li
        var $newFormLi = $('<li></li>').append(newForm).children('div').addClass('dflex').children().addClass('col-6 col-lg-3 col-xl-3 m-0 p-0');
        $newLinkLi.before($newFormLi);
    }
});                                                                                                                      