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

    // console.log(path)
    // console.log(path[path.length-1])
    let path = window.location.pathname.split('/');
    $('.cc').each(function () {
        $(this).children().removeClass('border....')
        $('.cc').each(function () {
            if ($(this).attr('href') === path[path.length - 1]) {
                $(this).children().addClass('border264d7efixe');
            }
        });
    });

    $(".rb").click(function () {
        var div = $("." + this.value);
        $('.div-hide').hide('slow');
        div.show("slow");
    });

    $(".mobilemenuadmin").click(function () {
        $(`.mm-admin`).addClass('m-admin');
        $(`.mm-admin`).toggle(`fold`, 1500);
    });

    $('.addcat').click(function(){
        $('.div-none').toggle(`fold`, 1500);
    })

    $('#addcategory').on('click', function(e){
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

    $('#addcustomer').on('click', function(e){
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

    $('#editcustomer').on('click', function(e){
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

    $('#search').on('click', function (e) {
        e.preventDefault()
        let email = $('.searchbar').val()
        $.ajax({
            type: 'GET',
            url: `/admin/searchcustomer`,
            data: { email: email },
            success: function (data) {
                $('#image_constructionSite_customer_lastname').val(data.lastname);
                $('#image_constructionSite_customer_email').val(data.email);
                $('#image_constructionSite_customer_addresOne').val(data.addresOne);
                $('#image_constructionSite_customer_zipcode').val(data.zipcode);
                $('#image_constructionSite_customer_city').val(data.city);
            }
        });
    });
});                                                                                                                      