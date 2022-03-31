window.bootstrap = require('bootstrap/dist/js/bootstrap.esm');
import $ from 'jquery';

import ajax_modal from "../components/modal/ajax_modal";

$('.js-trick-delete').on('click', function () {
    let target = this;
    ajax_modal(target, 'trick__modal');
});

$(".js-alert").fadeTo(6000, 0, function () {
    $(".js-alert").addClass('d-none');
});
