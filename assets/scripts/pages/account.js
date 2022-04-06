import $ from "jquery";
import ajaxModal from "../components/modal/ajax_modal";

$('.js-user-avatar-add').on('click', function (e) {
    e.preventDefault();
    $('.js-avatar-file').click();
});

// Avatar File
$('.js-avatar-file').on('change', function () {
    let target = this;
    let $avatar = $('#user-avatar');
    $avatar.find('img').remove();

    Array.prototype.forEach.call(target.files, function (file) {
        let img = '<img src="' + URL.createObjectURL(file) + '" class="thumbnail" alt="">';
        $avatar.append(img);
    });
});

$('.js-avatar-file').on('change', function () {
    $('#avatar_form').submit();
});

$('.js-user-avatar-remove').on('click', function () {
    let target = this;
    ajaxModal(target, 'trick__modal');
});