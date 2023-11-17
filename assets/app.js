/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

import Swal from 'sweetalert2';


// Variable qui contient le texte de la notification
let notification = document.getElementById("infos").textContent;
// Variable qui contient le titre de la notification
let notification2 = document.getElementById("infos_title").textContent;

// On appelle la fonction getNotifications une seule fois au chargement de la page
document.addEventListener("DOMContentLoaded", getNotifications);

// Fonction qui affiche la notification
function getNotifications() {
    // On affiche la notification avec SweetAlert2
    Swal.fire({
      title: notification2,
      text: notification, 
      icon: "info",
      position: "bottom-end",
      timer: 5000,
      showConfirmButton: false,
      toast: true,
    });
} 
  
