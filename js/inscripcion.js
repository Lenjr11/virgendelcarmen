var tbl_inscripcion_simple;
function listar_inscripcion_serverside() {
    tbl_inscripcion_simple = $("#tabla_inscripcion_simple").DataTable({
        "pageLenght": 10,
        "destroy": true,
        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
        "sAjaxSource": "../controller/inscripcion/serverside/serversideInscripcion.php",
        "columns": [
            { "defaultContent": "" },
            { "data": 1 },
            { "data": 2 },
            { "data": 3 },
            { "data": 4 },
            { "data": 5 },
            { "data": 6 },
            {"data": 7,
                render: function(data, type, row) {
                    if (data==''){
                    return "<button class='eliminar btn btn-danger btn-sm'><i class='fa fa-trash'></i></button>";
                }else{
                    return "<button class='mostrar btn btn-primary btn-sm'><i class='fa fa-question'></i></button>&nbsp;<button class='eliminar btn btn-danger btn-sm'><i class='fa fa-trash'></i></button>";
                }
                }
            },
        ],

        "language": idioma_espanol,
        select: true
    });
    tbl_inscripcion_simple.on('draw.td',function(){
        var PageInfo = $("#tabla_inscripcion_simple").DataTable().page.info();
        tbl_inscripcion_simple.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
}

function Registrar_inscripcion() {
    let dni = document.getElementById('dni').value;
    let nombres = document.getElementById('nombre').value;
    let apellidos = document.getElementById('apellido').value;
    let correo = document.getElementById('correo').value;
    let telefono = document.getElementById('telefono').value;
    let grado = document.getElementById('grado').value;
    let consulta = document.getElementById('consulta').value;
    if (dni.length == 0 || nombres.length == 0 || apellidos.length == 0 || telefono.length == 0 || grado.length == 0) {
        return Swal.fire("Error", "Los campos requeridos son obligatorios",
            "warning");
    }
    $.ajax({
        url: 'controller/inscripcion/controlador_inscripcion_registro.php',
        type: 'POST',
        data: {
          dni:dni,
          nombres:nombres,
          apellidos:apellidos,
          correo:correo,
          telefono:telefono,
          grado:grado,
          consulta:consulta

        }
    
    }).done(function(resp){ 
        if (resp > 0) {
            if(resp==1){
                LimpiarInscripcion();
                Swal.fire("MENSAJE", "Hemos recibido tu mensaje correctamente, pronto nos comunicaremos contigo!",
                    "success").then((value) => {
                        
                    });
            }else{
                Swal.fire("ERROR", "No se puede hacer más de una consulta para el mismo alumno!",
                "error");
            }
        } else {
            Swal.fire("Mensaje de Error", "Ups! Algo falló...",
                "error");
        }
    })
}

function LimpiarInscripcion() {
    document.getElementById('dni').value="";
    document.getElementById('nombre').value="";
    document.getElementById('apellido').value="";
    document.getElementById('correo').value="";
    document.getElementById('telefono').value="";
    document.getElementById('consulta').value="";
}

function Eliminar_inscripcion(id) {
    $.ajax({
        url: '../controller/inscripcion/controlador_inscripcion_eliminar.php',
        type: 'POST',
        data: {
          id:id
        }
    }).done(function(resp){ 
        if (resp > 0) {
            if(resp==1){
                Swal.fire("MENSAJE", "Solicitud Eliminada!",
                    "success").then((value) => {
                        tbl_inscripcion_simple.ajax.reload();
                    });
            }else{
                Swal.fire("ERROR", "No se puede hacer más de una consulta para el mismo alumno!",
                "error");
            }
        } else {
            Swal.fire("Mensaje de Error", "Ups! Algo falló...",
                "error");
        }
    })
}

$('#tabla_inscripcion_simple').on('click','.eliminar',function() {
    var data = tbl_inscripcion_simple.row($(this).parents('tr')).data();

    if(tbl_inscripcion_simple.row(this).child.isShown()){
        var data = tbl_inscripcion_simple.row(this).data();
    }
    Swal.fire({
        title: 'Está seguro de eliminar la solicitud?',
        text: "Esta accion no se puede revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, continuar!'
      }).then((result) => {
        if (result.isConfirmed) {
            Eliminar_inscripcion(data[0]);
        }
      })
})

$('#tabla_inscripcion_simple').on('click','.mostrar',function() {
    var data = tbl_inscripcion_simple.row($(this).parents('tr')).data();

    if(tbl_inscripcion_simple.row(this).child.isShown()){
        var data = tbl_inscripcion_simple.row(this).data();
    }

    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_consulta_padre").modal('show');
    document.getElementById('txt_consulta_mostrar').value=data[7];
})