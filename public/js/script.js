//boton para realizar importacion a excel 
    function openFileInput() {
        // Hacer clic en el campo de entrada de archivos oculto
        $('#fileInput').click();
    }


function enviarADevengacion() {
    // Obtiene las filas seleccionadas
    var filasSeleccionadas = document.querySelectorAll('.seleccionar-fila:checked');

    // Verifica si al menos una fila está seleccionada
    if (filasSeleccionadas.length > 0) {
        // Crea un array para almacenar los valores de las filas seleccionadas
        var valoresSeleccionados = Array.from(filasSeleccionadas).map(function (fila) {
            return fila.value;
        });
        // Asigna los valores al campo oculto
        document.getElementById('filasSeleccionadas').value = valoresSeleccionados.join(',');
        
        // Envia el formulario
        document.getElementById('myForm').submit();
    } else {
        // Muestra un mensaje de advertencia
        alert('Selecciona al menos una fila antes de enviar a devengación.');
    }
}
//PARA SELECCIONAR TODA LA FILA 
$(document).ready(function () {
    // Cuando se hace clic en "Seleccionar Todo"
    $('.seleccionar-todo').click(function () {
        // Obtiene el estado actual del checkbox "Seleccionar Todo"
        var isChecked = $(this).prop('checked');
        // Establece el mismo estado para todos los checkboxes de las filas
        $('.seleccionar-fila').prop('checked', isChecked);
    });

    // Cuando se hace clic en un checkbox de fila
    $('.seleccionar-fila').click(function () {
        // Desmarca el checkbox "Seleccionar Todo" si no todos los checkboxes de fila están marcados
        if ($('.seleccionar-fila:checked').length !== $('.seleccionar-fila').length) {
            $('.seleccionar-todo').prop('checked', false);
        }
    });
});


//Boton Busqueda
$(document).ready(function () {
    $('#busqueda').on('keyup', function () {
        var searchText = $(this).val().toLowerCase();

        $('table tbody tr').each(function () {
            var rowData = $(this).text().toLowerCase();
            if (rowData.indexOf(searchText) === -1) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });
    });

    // Restaura filas cuando se borra el contenido de búsqueda
    $('#busqueda').on('change', function () {
        if ($(this).val() === '') {
            $('table tbody tr').show();
        }
    });
});


//FUNCIONES PARA MOSTRAR LA COLUMNA DE MANERA ASCENDENTE Y DECENTENTE 
var arrowIcons = document.querySelectorAll(".arrow");
    var currentColumn = -1;
    var dir = "asc"; // Inicialmente, establece la dirección como ascendente

    function sortTable(columnIndex) {
        var table, rows, switching, i, x, y, shouldSwitch, switchcount = 0;
        table = document.querySelector(".table");
        switching = true;

        arrowIcons.forEach(function (arrow) {
            arrow.innerHTML = "&#9650;&#9660;";
        });

        if (currentColumn === columnIndex) {
            // Si es la misma columna, cambiar la dirección
            dir = (dir === "asc") ? "desc" : "asc";
        } else {
            // Si es una columna diferente, restablece la dirección a ascendente
            dir = "asc";
        }

        currentColumn = columnIndex; // Actualiza la columna actual
        // Cambia la flecha de la columna seleccionada
        arrowIcons[currentColumn].innerHTML = (dir === "asc") ? "&#9650;" : "&#9660;";

        while (switching) {
            switching = false;
            rows = table.rows;

            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;

                x = rows[i].getElementsByTagName("td")[columnIndex];
                y = rows[i + 1].getElementsByTagName("td")[columnIndex];

                if (dir === "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir === "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }

            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;
            } else {
                if (switchcount === 0 && dir === "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
