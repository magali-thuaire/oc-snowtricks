import $ from 'jquery';
import ajaxModal from "../components/modal/ajax_modal";
import loadmore from "../components/loadmore";

$('.js-trick-delete').on('click', function () {
    let target = this;
    ajaxModal(target, 'trick__modal');
});

$(".js-alert").fadeTo(6000, 0, function () {
    $(".js-alert").addClass('d-none');
});

// LOAD MORE BUTTON
loadmore();