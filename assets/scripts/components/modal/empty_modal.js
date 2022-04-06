import $ from "jquery";

// Suppression de la modale
export default function (modal) {
    // Ecoute du "click" sur le bouton fermer de la modale
    return $('button[data-bs-dismiss=modal]').click(function () {
        // Après fade-out
        setTimeout(function () {
            // Modale remise à 0
            $('#' + modal).empty();
        }, 0.5 * 1000);
    });
}