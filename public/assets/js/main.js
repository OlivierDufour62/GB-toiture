$(document).ready(function () {
    $(`.mobilemenu`).click(function () {
        $(`.mm`).toggle(`fold`,1500);
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
});