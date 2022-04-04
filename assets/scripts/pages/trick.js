import $ from 'jquery';
import ajax_modal from "../components/modal/ajax_modal";

$('.js-media-delete').on('click', function () {
    let target = this;
    ajax_modal(target, 'trick__modal');
});

$('.js-media-change').on('click', function () {
    let target = this;
    ajax_modal(target, 'trick__modal');
});

$('.js-media-update').on('click', function (e) {
    e.preventDefault();
    $('.js-media-update-file').click();
});

$('.js-media-update-file').on('change', function () {
    $('#trick_featured_image_form').submit();
});

$('#trick_form_medias').on('change', function (e) {
    let target = this;
    let $medias = $('#medias');
    $medias.empty();

    Array.prototype.forEach.call(target.files, function (file) {
        let img = '<div class="col"><img src="' + URL.createObjectURL(file) + '" class="img-thumbnail mt-3"></div>';
        $('#medias').append(img);
    });
})

