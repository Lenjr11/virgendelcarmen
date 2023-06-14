var tbl_alumno_simple;
function listar_alumno_serverside() {
    tbl_alumno_simple = $("#tabla_alumno_simple").DataTable({
        "pageLenght": 10,
        "destroy": true,
        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
        "sAjaxSource": "../controller/alumno/serverside/serversideAlumno.php",
        "columns": [
            { "defaultContent": "" },
            { "data": 1 },
            { "data": 3 },
            { "data": 4 },
            { "data": 5 },
            { "data": 6 },
            { "data": 9 },
            { "data": 7 },
            {"data": 8,
                render: function(data, type, row) {
                    if (data=='ACTIVO'){
                    return "<button class='editar btn btn-primary btn-sm'><i class='fa fa-edit'></i></button>&nbsp;<button class='desactivar btn btn-danger btn-sm'><i class='fa fa-trash'></i></button>";
                }else{
                    return "<button class='editar btn btn-primary btn-sm'><i class='fa fa-edit'></i></button>&nbsp;<button class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></button>";
                }
                }
            },
        ],

        "language": idioma_espanol,
        select: true
    });
    tbl_alumno_simple.on('draw.td',function(){
        var PageInfo = $("#tabla_alumno_simple").DataTable().page.info();
        tbl_alumno_simple.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
}

$('#tabla_alumno_simple').on('click','.editar',function() {
    var data = tbl_alumno_simple.row($(this).parents('tr')).data();

    if(tbl_alumno_simple.row(this).child.isShown()){
        var data = tbl_alumno_simple.row(this).data();
    }

    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_editar_alumno").modal('show');
    document.getElementById('txt_idalumno_editar').value=data[0];
    document.getElementById('txt_dni_editar').value=data[1];
    document.getElementById('txt_nacionalidad_editar').value=data[2];
    document.getElementById('txt_nombre_editar').value=data[3];
    document.getElementById('txt_fecha_editar').value=data[5];
    document.getElementById('txt_ciudad_editar').value=data[6];
    document.getElementById('txt_direccion_editar').value=data[7];
})

function AbrirModalRegistroAlumno() {
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_registro_alumno").modal({ backdrop: 'static', keyboard: false });
    $("#modal_registro_alumno").modal('show');

}


function Registrar_Alumno() {
    let dni = document.getElementById('txt_dni').value;
    let nacionalidad = document.getElementById('txt_nacionalidad').value;
    let nombre = document.getElementById('txt_nombre').value;
    let genero = document.getElementById('txt_genero').value;
    let nacimiento = document.getElementById('txt_fecha').value;
    let celular = document.getElementById('txt_celular').value;
    let ciudad = document.getElementById('txt_ciudad').value;
    let direccion = document.getElementById('txt_direccion').value;
    if (dni.length == 0 || nacionalidad.length == 0 || nombre.length == 0 || genero.length == 0 || nacimiento.length == 0 || ciudad.length == 0 || direccion.length == 0) {
        ValidarInput("txt_dni", "txt_nacionalidad", "txt_nombre", "txt_genero", "txt_fecha", "txt_ciudad", "txt_direccion");
        return Swal.fire("Error", "Los campos que aparecen en rojo son OBLIGATORIOS!",
            "warning");
    }
    $.ajax({
        url: '../controller/alumno/controlador_alumno_registro.php',
        type: 'POST',
        data: {
          dni:dni,
          nacionalidad:nacionalidad,
          nombre:nombre,
          genero:genero,
          nacimiento:nacimiento,
          celular:celular,
          ciudad:ciudad,
          direccion:direccion,
        }
    
    }).done(function(resp){
        if(isNaN(resp)){
            document.getElementById('div_mensaje_error').innerHTML='<br>'+
            '<div class="alert alert-danger alert-dismissible">'+
                '<h5><i class="icon fas fa-ban"></i> Revise los siguientes campos!</h5>'+
                resp+'</div>';
        }else{
            if (resp > 0) {
                if(resp==1){
                    LimpiarModalAlumno();
                    Swal.fire("Mensaje de Confirmación", "Nuevo Alumno registrado",
                        "success").then((value) => {
                            $("#modal_registro_alumno").modal('hide');
                            tbl_alumno_simple.ajax.reload();
                        });
                }else{
                    Swal.fire("ERROR", "Este Alumno ya se encuentra registrado en la base de datos",
                    "error");
                }
            } else {
                Swal.fire("Mensaje de Error", "Registro fallido",
                    "error");
            }
        }
    })
}

function ValidarInput(dni, nacionalidad, nombre, genero, nacimiento, ciudad, direccion) {
    Boolean(document.getElementById(dni).value.length > 0) ? $("#" + dni).
    removeClass("is-invalid").addClass("is-valid") : $("#" + dni).removeClass
    ("is-valid").addClass("is-invalid");

    Boolean(document.getElementById(nacionalidad).value.length > 0) ? $("#" + nacionalidad).
    removeClass("is-invalid").addClass("is-valid") : $("#" + nacionalidad).removeClass
    ("is-valid").addClass("is-invalid");

    Boolean(document.getElementById(nombre).value.length > 0) ? $("#" + nombre).
    removeClass("is-invalid").addClass("is-valid") : $("#" + nombre).removeClass
    ("is-valid").addClass("is-invalid");

    Boolean(document.getElementById(genero).value.length > 0) ? $("#" + genero).
    removeClass("is-invalid").addClass("is-valid") : $("#" + genero).removeClass
    ("is-valid").addClass("is-invalid");

    Boolean(document.getElementById(nacimiento).value.length > 0) ? $("#" + nacimiento).
    removeClass("is-invalid").addClass("is-valid") : $("#" + nacimiento).removeClass
    ("is-valid").addClass("is-invalid");

    Boolean(document.getElementById(ciudad).value.length > 0) ? $("#" + ciudad).
    removeClass("is-invalid").addClass("is-valid") : $("#" + ciudad).removeClass
    ("is-valid").addClass("is-invalid");

    Boolean(document.getElementById(direccion).value.length > 0) ? $("#" + direccion).
    removeClass("is-invalid").addClass("is-valid") : $("#" + direccion).removeClass
    ("is-valid").addClass("is-invalid");
}

function LimpiarModalAlumno() {
    document.getElementById('txt_dni').value="";
    document.getElementById('txt_nombre').value="";
    document.getElementById('txt_fecha').value="";
    document.getElementById('txt_celular').value="";
    document.getElementById('txt_direccion').value="";
}

function Modificar_Alumno(){
    let id = document.getElementById('txt_idalumno_editar').value;
    let nombre = document.getElementById('txt_nombre_editar').value;
    let ciudad = document.getElementById('txt_ciudad_editar').value;
    let direccion = document.getElementById('txt_direccion_editar').value;
    if(id.lenght==0 || nombre.length == 0 || ciudad.length == 0 || direccion.length == 0){
        ValidarInput("txt_nombre_editar","txt_ciudad_editar", "txt_direccion_editar");
        return Swal.fire("ERROR", "Hay campos vacios!",
            "warning");
    }
    $.ajax({
        url: '../controller/alumno/controlador_alumno_modificar.php',
        type: 'POST',
        data: {
           id:id,
           nombre:nombre,
           ciudad:ciudad,
           direccion:direccion
        }
    
    }).done(function(resp){ 
        if (resp > 0) {
                Swal.fire("MENSAJE", "ALUMNO MODIFICADO",
                    "success").then((value) => {
                        $("#modal_editar_alumno").modal('hide');
                        tbl_alumno_simple.ajax.reload();
                    });

        } else {
            Swal.fire("Mensaje de Error", "No se pudo actualizar los datos",
                "error");
        }
    })
}

function Modificar_Estatus(id,estado){
    $.ajax({
        url: '../controller/alumno/controlador_modificar_alumno_estatus.php',
        type: 'POST',
        data: {
          id:id,
          estado:estado
        }
    
    }).done(function(resp){ 
        if (resp > 0) {
                Swal.fire("Mensaje de Confirmación", "Alumno dado de baja",
                    "success").then((value) => {
                        tbl_alumno_simple.ajax.reload();
                    });

        } else {
            Swal.fire("Mensaje de Error", "No se pudo eliminar al alumno",
                "error");
        }
    })
}

$('#tabla_alumno_simple').on('click','.desactivar',function() {
    var data = tbl_alumno_simple.row($(this).parents('tr')).data();

    if(tbl_alumno_simple.row(this).child.isShown()){
        var data = tbl_usuario_simple.row(this).data();
    }
    Swal.fire({
        title: 'Está seguro de eliminar al alumno '+data[3]+'?',
        text: "Esta accion no se puede revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, continuar!'
      }).then((result) => {
        if (result.isConfirmed) {
            Modificar_Estatus(data[0],"INACTIVO");
        }
      })
})