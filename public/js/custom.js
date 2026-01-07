// JavaScript Document

$(document).ready( function () {
    $('#myTable').DataTable({
		language: {
        processing:     "Procesando...",
        search:         "Buscar:",
        lengthMenu:    "Mostrar _MENU_ elementos",
        info:           "Mostrando desde _START_ hasta _END_ de _TOTAL_ elementos",
        infoEmpty:      "Mostrando desde 0 hasta 0 de 0 elementos",
        infoFiltered:   "(filtrado de _MAX_ elementos en total)",
        infoPostFix:    "",
        loadingRecords: "Cargando...",
        zeroRecords:    "No se encontraron elementos para mostrar",
        emptyTable:     "No hay datos disponibles en la tabla",
        paginate: {
            first:      "Primero",
            previous:   "Anterior",
            next:       "Siguiente",
            last:       "Último"
        },
        aria: {
            sortAscending:  ": activar para ordenar la columna de manera ascendente",
            sortDescending: ": activar para ordenar la columna de manera descendente"
        }
		
    },
		lengthMenu: [
        [10, 50, 100, -1],
        [10, 50, 100, 'All']
		]
		
		
	});
	
    $('#filterLastMonthBtn').click(function() {
		
        var fechaInicio = new Date();
        fechaInicio.setDate(1); // Primer día del mes actual
        fechaInicio.setMonth(fechaInicio.getMonth() - 1); // Mes anterior

        var fechaFin = new Date(fechaInicio.getFullYear(), fechaInicio.getMonth() + 1, 0); // Último día del mes anterior

        $('#fecha_inicio').val(formatDate(fechaInicio));
        $('#fecha_fin').val(formatDate(fechaFin));

        $('#formFiltraPartes').submit(); // Asegúrate de que este selector apunte a tu formulario específico
    });
$('#filterMonthBtn').click(function() {
		
        var fechaInicio = new Date();
        fechaInicio.setDate(1); // Primer día del mes actual
        fechaInicio.setMonth(fechaInicio.getMonth() - 1); // Mes anterior

        var fechaFin = new Date(fechaInicio.getFullYear(), fechaInicio.getMonth() + 1, 0); // Último día del mes anterior

        $('#fecha_inicio').val(formatDate(fechaInicio));
        $('#fecha_fin').val(formatDate(fechaFin));

        $('#formFiltraPartes').submit(); // Asegúrate de que este selector apunte a tu formulario específico
    });

    
} );
function formatDate(date) {
        var month = '' + (date.getMonth() + 1),
            day = '' + date.getDate(),
            year = date.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year, month, day].join('-');
    }
