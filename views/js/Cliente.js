$(document).ready(function(){
    $('#formCliente').submit(function(event){
        event.preventDefault();

        var datosFormulario = {
            "nombre": $("#nombre").val(),
            "apellidoP": $("#apellidoP").val(),
            "apellidoM": $("#apellidoM").val(),
            "ciudad": $("#ciudad").val(),
            "categoria": $("#categoria").val()
        };

        var jsonData = JSON.stringify(datosFormulario);
        
        $.ajax({
            url: 'http://localhost/API_PHP/createClient',
            method: 'POST',
            dataType: 'json',
            contentType: 'application/json',
            data: jsonData,
            success: function(response){
                Swal.fire({
                    icon: 'success',
                    title: 'Registro almacenado',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.reload();
                })
            },
            error: function(error){
                Swal.fire({
                    icon: 'Error',
                    title: 'Algo salió mal',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
    })

    $.ajax({
        url: 'http://localhost/API_PHP/clientes',
        method: 'GET',
        dataType: 'json',
        success: function(response){
            var data = response.data;
            var tabla = $('#tablaClientes');

            data.forEach(element => {
                var fila = $('<tr>');

                fila.append($('<th scope="row">').text(element.id));
                fila.append($('<td>').text(element.nombre));
                fila.append($('<td>').text(element.apellido1));
                fila.append($('<td>').text(element.apellido2));
                fila.append($('<td>').text(element.ciudad));
                fila.append($('<td>').text(element.categoría));

                tabla.append(fila);
            });
        }
    });
})