

document.getElementById('registroForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const clave1 = document.getElementById('usuario_clave_1').value;
    const clave2 = document.getElementById('usuario_clave_2').value;
    
    if (clave1 !== clave2) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Las contraseñas no coinciden.',
            confirmButtonText: 'Intentar de nuevo'
        });
        return;
    }

    Swal.fire({
        icon: 'success',
        title: 'Registro Exitoso',
        text: 'El usuario ha sido registrado correctamente en el sistema.',
        confirmButtonText: 'Aceptar'
    }).then(() => {
        this.reset();
    });
});

// Update file input to show selected filename
document.getElementById('usuario_foto').addEventListener('change', function(event) {
    const fileName = event.target.files[0] ? event.target.files[0].name : 'Seleccionar Archivo';
    document.querySelector('.file-input-text').textContent = fileName;
});
