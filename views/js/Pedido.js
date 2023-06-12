$(document).ready(function(){
    
    //Opciones de clientes
    cargarClientes();
    //Opciones de comerciales
    carcarComerciales();

    $('#formCliente').submit(function(event){
        event.preventDefault();

        var datosFormulario = {
            "total": $('#total').val(),
            "fecha": $('#fecha').val(),
            "id_cliente": $('#cliente').val(),
            "id_comercial": $('#comercial').val()
        }

        var jsonData = JSON.stringify(datosFormulario);

        $.ajax({
            url: 'http://localhost/API_PHP/createPedido',
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
                    window.location.href = '../index.html';
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
        })
    });
});

function cargarClientes(){
    $.ajax({
        url: 'http://localhost/API_PHP/clientes',
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            var data = response.data;
            var option = $("#cliente");
            option.empty();

            data.forEach(element => {
                option.append($('<option>').val(element.id.toString()).text(element.nombre + ' ' + element.apellido1 + ' ' + element.apellido2));
            });
        },
        error: function(error){
            console.log(error);
        }
    });
}

function carcarComerciales(){
    $.ajax({
        url: "http://localhost/API_PHP/comerciales",
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            var data = response.data;
            var option = $("#comercial");
            option.empty();

            data.forEach(element => {
                option.append($('<option>').val(element.id.toString()).text(element.nombre + ' ' + element.apellido1 + ' ' + element.apellido2));
            });
        },
        error: function(error){
            console.log(error);
        }
    });
}