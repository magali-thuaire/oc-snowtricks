import $ from 'jquery';

// Couleur de la barre de navigation après le scroll
$(function () {
    $(document).scroll(function () {
        let $nav = $(".navbar-custom.fixed-top");
        let $logo = $(".navbar-logo");
        $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
        $logo.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
    });
});