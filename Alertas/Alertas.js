function MostrarAlerta(){
    swal({
        title: "¡ERROR!",
        text: "Esto es un mensaje de error",
        type: "error",
      });
  }

function confirmarEliminacion(url) {
    console.log("Función confirmarEliminacion ejecutada");
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esta acción.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar',
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}

function enviarFormulario() {
    // Enviamos el formulario
    document.querySelector('form').submit();
    
    // Muestra mensaje de éxito (esto solo será visible si no hay un redireccionamiento después de enviar el formulario)
    Swal.fire(
        'Guardado!',
        'Su dato ha sido almacenado con éxito.',
        'success'
    );
}
