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

    $('.anim').mouseenter(function () {
        console.log('coucou')
        // $(this).children('.animjs').addClass('anim-opa');
        $(this).children('.animjs').css('animation-name', 'prestation');
    });

    $('.anim').mouseleave(function () {
        console.log('coucou')
        // $(this).children('.animjs').removeClass('anim-opa');
        $(this).children('.animjs').css('animation-name', 'prestationleave');
    });
});