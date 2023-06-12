$(document).ready(function () {
    $('#formComercial').submit(function(event){
        event.preventDefault();

        var datosFormulario = {
            "nombre": $('#nombre').val(),
            "apellidoP": $('#apellidoP').val(),
            "apellidoM": $('#apellidoM').val(),
            "comision": $('#comision').val()
        }

        var jsonData = JSON.stringify(datosFormulario);

        $.ajax({
            url: "http://localhost/API_PHP/createComercial",
            method: 'POST',
            dataType: 'json',
            data: jsonData, 
            contentType: 'application/json',
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
        url: "http://localhost/API_PHP/comerciales",
        method: "GET",
        dataType: "json",
        success: function (response) {
            var data = response.data;
            var tabla = $('#tablaClientes');

            data.forEach(element => {
                var fila = $('<tr>');

                fila.append($('<th scope="row">').text(element.id));
                fila.append($('<td>').text(element.nombre));
                fila.append($('<td>').text(element.apellido1));
                fila.append($('<td>').text(element.apellido2));
                fila.append($('<td>').text(element.comisión));

                tabla.append(fila);
            });
        },
        error: function(error){
            console.log(error)
        }
    });

})