function eliminarFila(id) {
    // Obtén el token CSRF
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    // Confirma si realmente se desea eliminar la fila
    if (confirm('¿Estás seguro de que deseas eliminar esta empresa?')) {
        // Realiza una solicitud AJAX para eliminar la empresa por su ID
        fetch(`/eliminar-fila/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })        .then(data => {
            // Maneja la respuesta del servidor, puedes recargar la página o realizar otras acciones
            console.log(data);
        })
        .catch(error => {
            console.error('Error al eliminar la fila:', error);
        });
    }
}
