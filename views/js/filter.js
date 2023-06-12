function filterPedidos(){
    var categoria = $('#filtroCategoria').val();

    var datosFiltrados = pedidos.filter(function(dato){
        var fecha = new Date(dato.fecha);
        var anio = fecha.getFullYear();

        if (categoria === '') {
            return true; 
        } else {
            return anio == categoria;
        }
    })

    actualizarTabla(datosFiltrados);
}

function actualizarTabla(datos){
    var tabla = $("#tablaPedidos tbody")
    tabla.empty();

    datos.forEach(element => {
        var fecha = new Date(element.fecha);
        var fila = $('<tr>');

        fila.append($('<th scope="row">').text(element.id));
        fila.append($('<td>').text(element.total));
        fila.append($('<td>').text(fecha.getDate() + '/' + fecha.getMonth() + 1 + '/' + fecha.getFullYear()));
        fila.append($('<td>').text(element.Cliente));
        fila.append($('<td>').text(element.Apellido1_Cliente));
        fila.append($('<td>').text(element.Apellido2_Cliente));  
        fila.append($('<td>').text(element.Comercial));
        fila.append($('<td>').text(element.Apellido1_Comercial));
        fila.append($('<td>').text(element.Apellido1_Comercial));            

        tabla.append(fila);
    });
}