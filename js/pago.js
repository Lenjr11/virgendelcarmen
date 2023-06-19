var tbl_pago_simple;
function listar_pago_serverside() {
    tbl_pago_simple = $("#tabla_pago_simple").DataTable({
        scrollX: true,
        "pageLenght": 10,
        "destroy": true,
        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
        "sAjaxSource": "../controller/pago/serverside/serversidePago.php",
        "columns": [
            { "defaultContent": "" },
            { "data": 2 },
            { "data": 8 },
            { "data": 4 },
            { "data": 9 },
            { "data": 5 },
            { "data": 6 },
            { "data": 7 },
            {"data": 6,
                render: function(data, type, row) {
                    if (data=='Efectivo'){
                    return "<a class='btn btn-info' href='../controller/boletas/invoice.php?id=" + row[0] + "' target='_blank' role='button'><i class='fa fa-download'></i></a>";
                }else{
                    return "<a class='btn btn-info' href='../controller/boletas/invoice.php?id=" + row[0] + "' target='_blank' role='button'><i class='fa fa-download'></i></a>";
                }
                }
            },
        ],

        "language": idioma_espanol,
        select: true
    });
    tbl_pago_simple.on('draw.td',function(){
        var PageInfo = $("#tabla_pago_simple").DataTable().page.info();
        tbl_pago_simple.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
}

function AbrirModalRegistroPago() {
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_registro_pago").modal({ backdrop: 'static', keyboard: false });
    $("#modal_registro_pago").modal('show');

}

function cargar_select_cod() {
    $.ajax({
        url: '../controller/pago/controlador_cargar_select_cod.php',
        type: 'POST'

    }).done(function (resp) {
        let data = JSON.parse(resp);
        let llenardata = "";
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                if (data[i][0] !="3"){
                   llenardata += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
                }
                
            }

            document.getElementById('select_cod').innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos en la bd</option>";
            document.getElementById('select_cod').innerHTML = llenardata;
        }
    })
}

function Registrar_Pago() {
    let code = document.getElementById('select_cod').value;
    let monto = document.getElementById('txt_monto').value;
    let descripcion = document.getElementById('txt_descripcion').value;
    let mes = document.getElementById('txt_mes').value;
    let fecha = document.getElementById('txt_fecha_pago').value;
    let modalidad = document.getElementById('txt_modalidad').value;
    let operacion = document.getElementById('txt_operacion').value;
    let registro = document.getElementById('txt_registro_fecha').value;
    let enviar = document.getElementById('txt_enviar').value;
    if (code.length == 0 || monto.length == 0 || descripcion.length == 0 || fecha.length == 0 || modalidad.length == 0 ) {
        return Swal.fire("Error", "Los campos requeridos son obligatorios",
            "warning");
    }
    $.ajax({
        url: '../controller/pago/controlador_pago_registro.php',
        type: 'POST',
        data: {
          code:code,
          monto:monto,
          descripcion:descripcion,
          mes:mes,
          fecha:fecha,
          modalidad:modalidad,
          operacion:operacion,
          registro:registro,
          enviar:enviar

        }
    
    }).done(function(resp){ 
        if (resp > 0) {
            if(resp==1){
                Swal.fire("Mensaje de Confirmación", "Nuevo Pago registrado",
                    "success").then((value) => {
                        $("#modal_registro_pago").modal('hide');
                        tbl_pago_simple.ajax.reload();
                    });
            }else{
                Swal.fire("ERROR", "Mes o matrícula ya cancelada!",
                "error");
            }
        } else {
            Swal.fire("Mensaje de Error", "Registro fallido",
                "error");
        }
    })
}

$('#tabla_pago_simple').on('click','.editar',function() {
    var data = tbl_pago_simple.row($(this).parents('tr')).data();

    if(tbl_pago_simple.row(this).child.isShown()){
        var data = tbl_pago_simple.row(this).data();
    }

    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_editar_pago").modal('show');
    document.getElementById('txt_idpago_editar').value=data[0];
    $("#select_cod_editars").select().val(data[1]).trigger('change.select2');
    document.getElementById('txt_monto_editar').value=data[7];
    $("#txt_descripcion_editar").select().val(data[4]).trigger('change.select2');
})



function Modificar_Pago(){
    let id = document.getElementById('txt_idusuario_editar').value;
    let nombre = document.getElementById('txt_nombre_editar').value;
    let apellido = document.getElementById('txt_apellido_editar').value;
    let telefono = document.getElementById('txt_telefono_editar').value;
    let email = document.getElementById('txt_email_editar').value;
    let rol = document.getElementById('select_rol_editar').value;
    if (id.length == 0 || nombre.length == 0 || apellido.length == 0 || telefono.length == 0 || email.length == 0 || rol.length == 0 ) {
        ValidarInput("txt_usuario_editar","txt_nombre_editar","txt_apellido_editar","txt_telefono_editar", "txt_email_editar","");
        return Swal.fire("Mensaje de advertencia", "Tiene algunos campos vacios",
            "warning");
    }

    if (validar_email(email)) {

    }else{
    return Swal.fire("Mensaje de Advertencia", "El formato ingresado del email es incorrecto",
    "warning");
    }

    $.ajax({
        url: '../controller/usuario/controlador_modificar_usuario.php',
        type: 'POST',
        data: {
          id:id,
          nombre:nombre,
          apellido:apellido,
          telefono:telefono,
          email:email,
          rol:rol
        }
    
    }).done(function(resp){ 
        if (resp > 0) {
                Swal.fire("MENSAJE", "USUARIO MODIFICADO",
                    "success").then((value) => {
                        $("#modal_editar_usuario").modal('hide');
                        tbl_usuario_simple.ajax.reload();
                    });

        } else {
            Swal.fire("Mensaje de Error", "No se pudo actualizar los datos",
                "error");
        }
    })
}

function generarBoleta(idPago) {
    $.ajax({
        url: '../controller/boletas/invoice.php',
        method: 'POST',
        data: { idPago: idPago },
        success: function (response) {
            // Abrir la boleta generada en una nueva ventana
            window.open('../controller/boletas/' + response, '_blank');
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}