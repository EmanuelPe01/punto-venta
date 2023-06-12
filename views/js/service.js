var pedidos;
$(document).ready(function(){
    $.ajax({
        url: 'http://localhost/API_PHP/pedidos',
        method: 'GET',
        dataType: 'json',
        success: function(response){
            pedidos = response.data;
            var tabla = $("#tablaPedidos tbody")
            
            pedidos.forEach(element => {
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
                            
        },
        error: function(error){
            console.log(error)
        }
    })

    $.ajax({
        url: 'http://localhost/API_PHP/fechas',
        method: 'GET',
        dataType: 'json',
        success: function(response){
            var clientes = response.data;
            var option = $("#filtroCategoria");

            option.empty();
            option.append($('<option>').val('').text('Todos'));

            clientes.forEach(element => {
                option.append($('<option>').val(element.anio.toString()).text(element.anio));
            })
        },
        error: function(error){
            console.log(error)
        }
    });

})