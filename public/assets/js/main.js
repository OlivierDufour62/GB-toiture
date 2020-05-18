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

    $(".anim").hover(function() {
        $(".anim-opa").css("animation-play-state", "running");
    });
    $(".anim").click(function() {
        $(".display-anim").css("animation-play-state", "paused");
    });
});