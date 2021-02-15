/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';
import bsCustomFileInput from "bs-custom-file-input";
import jquery from 'jquery';
import Bloodhound from "bloodhound-js"
window.Bloodhound = require('bloodhound-js');


import '/assets/js/typeahead.jquery'
import '/assets/js/bloodhound'
import '/assets/js/typeahead.bundle'

bsCustomFileInput.init();

const $ = require('jquery');
global.$ = global.jQuery = $;
console.log("test")

//check if jquery is loaded
// window.onload = function() {
//     if (window.jQuery) {
//         // jQuery is loaded
//         alert("Yeah!");
//     } else {
//         // jQuery is not loaded
//         alert("Doesn't Work");
//     }
// }

