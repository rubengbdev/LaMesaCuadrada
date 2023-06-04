/**
 * Control de evento del submit del formulario de crear noticias
 */
$(document).ready(function() {

    $('#publicar-noticias').submit(function(event) {
        event.preventDefault(); // Evitar envío predeterminado del formulario
        event.stopPropagation();

        // Obtener los datos del formulario
        var formData = $(this).serialize();
        console.log(formData);
        // Realizar la solicitud AJAX
        $.ajax({
            type: 'POST',
            url: 'http://localhost:8001/noticias',
            data: formData,
            success: function(response) {
                alert("Noticia publicada");
                window.location.href = 'index.php';
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
});