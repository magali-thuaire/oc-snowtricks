import $ from "jquery";
import loadmore from "./loadmore";

// Appel AJAX
export default function () {
    $('.js-comment-load-more').on('click', function () {
        let target = this;
        let url = $(target).data('href');
        let click = $(target).data('click');
        // Appel ajax vers l'action symfony qui nous renvoie la vue
        return $.ajax({
            method: 'GET',
            url: url + '?click=' + click
        }).done(function (data) {
            // Vide le html et Injecte le html
            $('.js-comment-list').empty().html(data);
            loadmore();
        });
    });

    $('.js-trick-load-more').on('click', function () {
        let target = this;
        let url = $(target).data('href');
        let click = $(target).data('click');
        // Appel ajax vers l'action symfony qui nous renvoie la vue
        return $.ajax({
            method: 'GET',
            url: url + '?click=' + click
        }).done(function (data) {
            // Vide le html et Injecte le html
            $('.js-trick-list').empty().html(data);
            loadmore();
        });
    })

}