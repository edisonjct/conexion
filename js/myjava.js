$(document).ready(pagination(1));
$(function () {
    $('#bt-creditosemp').on('click', function () {
        var desde = $('#bd-desde').val();
        var hasta = $('#bd-hasta').val();
        var IDB = $('#IDB').val();
        var condicion = $('#cb-condicion').val();
        $('#agrega-registros').html('<h2><div align="center"><img src="../recursos/cargando2.gif" width="100" /><div></h2>');
        var url = '../php/BuscaFacturas.php';
        $.ajax({
            type: 'GET',
            url: url,
            data: 'desde=' + desde + '&hasta=' + hasta + '&IDB=' + IDB + '&condicion=' + condicion,
            success: function (datos) {
                $('#agrega-registros').html(datos);
            }
        });
        return false;
    });



});


function reporteF() {
    var desde = $('#bd-desde').val();
    var hasta = $('#bd-hasta').val();
    var IDB = $('#IDB').val();
    var condicion = $('#cb-condicion').val();
    window.location.href = '../php/ExcelFacturas.php?desde=' + desde + '&hasta=' + hasta + '&IDB=' + IDB + '&condicion=' + condicion;
}

function agregaRegistro() {
    var url = '../php/agrega_producto.php';
    $.ajax({
        type: 'GET',
        url: url,
        data: $('#formulario').serialize(),
        success: function (registro) {
            if ($('#pro').val() == 'Registro') {
                $('#formulario')[0].reset();
                $('#mensaje').addClass('bien').html('Registro completado con exito').show(200).delay(2500).hide(200);
                $('#agrega-registros').html(registro);
                return false;
            } else {
                $('#mensaje').addClass('bien').html('Edicion completada con exito').show(200).delay(2500).hide(200);
                $('#agrega-registros').html(registro);
                return false;
            }
        }
    });
    return false;
}

function eliminarProducto(id, es) {
    var url = '../php/elimina_producto.php';
    var pregunta = confirm('¿Esta seguro de eliminar este Ticket?');
    if (pregunta == true) {
        $.ajax({
            type: 'GET',
            url: url,
            data: 'id=' + id + '&es=' + es,
            success: function (registro) {
                $('#agrega-registros').html(registro);
                return false;
            }
        });
        return false;
    } else {
        return false;
    }
}

function editarProducto(id) {
    $('#formulario')[0].reset();
    var url = '../php/edita_producto.php';
    $.ajax({
        type: 'GET',
        url: url,
        data: 'id=' + id,
        success: function (valores) {
            var datos = eval(valores);
            $('#reg').hide();
            $('#edi').show();
            $('#pro').val('Edicion');
            $('#id').val(id);
            $('#detalle').val(datos[0]);
            $('#area').val(datos[1]);
            $('#usuario').val(datos[2]);
            $('#estado').val(datos[3]);
            $('#tecnico').val(datos[4]);
            $('#grupo').val(datos[5]);
            $('#registra-producto').modal({
                show: true,
                backdrop: 'static'
            });
            return false;
        }
    });
    return false;
}


function pagination(partida) {
    var url = '../php/paginarTickets.php';
    $.ajax({
        type: 'POST',
        url: url,
        data: 'partida=' + partida,
        success: function (data) {
            var array = eval(data);
            $('#agrega-registros').html(array[0]);
            $('#pagination').html(array[1]);
        }
    });
    return false;
}

function confirmation() {
    var imprimir = confirm("ESTA SEGURO DE IMPRIMIR ?")
    if (imprimir) {
        var objeto = document.getElementById('imprimeme');  //obtenemos el objeto a imprimir
        var ventana = window.open('', '_blank');  //abrimos una ventana vacía nueva
        ventana.document.write(objeto.innerHTML);  //imprimimos el HTML del objeto en la nueva ventana
        ventana.document.close();  //cerramos el documento
        ventana.print();  //imprimimos la ventana
        ventana.close();  //cerramos la ventana	 
        window.close();
    } else {
        alert("SE CANCELO LA IMPRESION")
        window.close();
    }
}