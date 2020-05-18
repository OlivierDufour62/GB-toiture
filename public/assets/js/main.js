$(document).ready(function () {
    $(`.mobilemenu`).click(function () {
        $(`.mm`).slideToggle(`slow`);
    });

    $(`.mobilefoot`).click(function () {
        $(`div.child`).children().first().toggle(`slow`);
    });

    $(`.hov`).hover(function () {
        $(this).addClass(`border264d7e`);
    }, function () {
        $(this).removeClass(`border264d7e`);
    });
});