$(document).ready(function () {
    $(`.mobilemenu`).click(function () {
        $(`.mm`).slideToggle(`slow`);
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
});