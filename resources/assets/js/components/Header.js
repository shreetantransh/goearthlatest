$(function () {

    $('a#sidebar-menu-toggle, #reset-menu').on('click', function (e) {
        e.preventDefault();

        $('body').toggleClass('sidebar-menu-open');
    });
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("body").toggleClass("toggled");
    });
});