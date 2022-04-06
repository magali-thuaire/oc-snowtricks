import $ from 'jquery';
import ajaxModal from "../components/modal/ajax_modal";

$('.js-media-delete').on('click', function () {
    let target = this;
    ajaxModal(target, 'trick__modal');
});

$('.js-media-change').on('click', function () {
    let target = this;
    ajaxModal(target, 'trick__modal');
});

$('.js-media-update').on('click', function (e) {
    e.preventDefault();
    $('.js-media-update-file').click();
});

$('.js-media-update-file').on('change', function () {
    $('#trick_featured_image_form').submit();
});

// Media Image Files
$('#trick_form_medias').on('change', function () {
    let target = this;
    let $medias = $('#medias');
    $medias.empty();

    Array.prototype.forEach.call(target.files, function (file) {
        let img = '<div class="col"><img src="' + URL.createObjectURL(file) + '" class="img-thumbnail mt-3" alt=""></div>';
        $medias.append(img);
    });
});

// Featured image
$('#trick_form_file').on('change', function () {
    let target = this;
    let $image = $('#featured-image');
    $image.empty();

    Array.prototype.forEach.call(target.files, function (file) {
        let img = '<img src="' + URL.createObjectURL(file) + '" alt="">';
        $image.append(img);
    });
});
