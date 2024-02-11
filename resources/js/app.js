// import './bootstrap';
import izitoast from 'izitoast/dist/js/iziToast.min.js';
window.iziToast = izitoast;

$('form').on('keypress', function(e) {
    if (e.which === 13) {
    e.preventDefault();
    // Programmatically click the submit button
    $('form').submit();
    }
});

	