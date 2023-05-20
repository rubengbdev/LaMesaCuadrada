 // Muestra el botón cuando el usuario ha desplazado 20 píxeles desde la parte superior de la página
 window.onscroll = function() {
    scrollFunction()
};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("scrollBtn").style.display = "block";
    } else {
        document.getElementById("scrollBtn").style.display = "none";
    }
}

// Cuando el usuario hace clic en el botón, vuelve al inicio de la página
function topFunction() {
    document.body.scrollTop = 0; // Para Safari
    document.documentElement.scrollTop = 0; // Para Chrome, Firefox, IE y Opera
}