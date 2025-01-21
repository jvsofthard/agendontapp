document.querySelector('form').addEventListener('submit', function(e) {
    const motivo = document.querySelector('[name="motivo"]').value;
    if (motivo.trim() === '') {
        alert('El motivo no puede estar vacío.');
        e.preventDefault();
    }
});
