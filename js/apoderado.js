var tbl_apoderado_simple;
function listar_apoderado_serverside() {
    tbl_apoderado_simple = $("#tabla_apoderado_simple").DataTable({
        scrollX: true,
        "pageLenght": 10,
        "destroy": true,
        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
        "sAjaxSource": "../controller/apoderado/serverside/serversideApoderado.php",
        "columns": [
            { "defaultContent": "" },
            { "data": 1 },
            { "data": 2 },
            { "data": 9 },
            { "data": 10 },
            { "data": 16 },
            { "data": 17 },
            {"data": 7,
                render: function(data, type, row) {
                    if (data=='ACTIVO'){
                    return "<button class='info btn btn-info btn-sm'><i class='fa fa-info'></i></button>&nbsp;<button class='editar btn btn-primary btn-sm'><i class='fa fa-edit'></i></button>&nbsp;<button class='desactivar btn btn-danger btn-sm'><i class='fa fa-trash'></i></button>";
                }else{
                    return "<button class='info btn btn-info btn-sm'><i class='fa fa-info'></i></button>&nbsp;<button class='editar btn btn-primary btn-sm'><i class='fa fa-edit'></i></button>&nbsp;<button class='desactivar btn btn-danger btn-sm'><i class='fa fa-trash'></i></button>";
                }
                }
            },
        ],

        "language": idioma_espanol,
        select: true
    });
    tbl_apoderado_simple.on('draw.td',function(){
        var PageInfo = $("#tabla_apoderado_simple").DataTable().page.info();
        tbl_apoderado_simple.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
}

$('#tabla_apoderado_simple').on('click','.editar',function() {
    var data = tbl_apoderado_simple.row($(this).parents('tr')).data();

    if(tbl_apoderado_simple.row(this).child.isShown()){
        var data = tbl_apoderado_simple.row(this).data();
    }

    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_editar_apoderado").modal('show');
    document.getElementById('txt_idmadre_editar').value=data[0];
    document.getElementById('txt_dni_madre_editar').value=data[1];
    document.getElementById('txt_nacionalidad_madre_editar').value=data[22];
    document.getElementById('txt_nombre_madre_editar').value=data[2];
    document.getElementById('txt_genero_madre_editar').value=data[23];
    document.getElementById('txt_fecha_madre_editar').value=data[24];
    document.getElementById('txt_ciudad_madre_editar').value=data[3];
    document.getElementById('txt_direccion_madre_editar').value=data[4];
    document.getElementById('txt_correo_madre_editar').value=data[5];
    document.getElementById('txt_telefono_madre_editar').value=data[6];
    //--
    document.getElementById('txt_idpadre_editar').value=data[8];
    document.getElementById('txt_dni_padre_editar').value=data[9];
    document.getElementById('txt_nacionalidad_padre_editar').value=data[25];
    document.getElementById('txt_nombre_padre_editar').value=data[10];
    document.getElementById('txt_genero_padre_editar').value=data[26];
    document.getElementById('txt_fecha_padre_editar').value=data[27];
    document.getElementById('txt_ciudad_padre_editar').value=data[11];
    document.getElementById('txt_direccion_padre_editar').value=data[12];
    document.getElementById('txt_correo_padre_editar').value=data[13];
    document.getElementById('txt_telefono_padre_editar').value=data[14];
    //--
    document.getElementById('txt_idapoderado_editar').value=data[15];
    document.getElementById('txt_dni_apoderado_editar').value=data[16];
    document.getElementById('txt_nacionalidad_apoderado_editar').value=data[28];
    document.getElementById('txt_nombre_apoderado_editar').value=data[17];
    document.getElementById('txt_genero_apoderado_editar').value=data[29];
    document.getElementById('txt_parentesco_apoderado_editar').value=data[30];
    document.getElementById('txt_fecha_apoderado_editar').value=data[31];
    document.getElementById('txt_ciudad_apoderado_editar').value=data[18];
    document.getElementById('txt_direccion_apoderado_editar').value=data[19];
    document.getElementById('txt_correo_apoderado_editar').value=data[20];
    document.getElementById('txt_telefono_apoderado_editar').value=data[21];
})

$('#tabla_apoderado_simple').on('click','.info',function() {
    var data = tbl_apoderado_simple.row($(this).parents('tr')).data();

    if(tbl_apoderado_simple.row(this).child.isShown()){
        var data = tbl_apoderado_simple.row(this).data();
    }

    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_info_apoderado").modal('show');
    document.getElementById('txt_idmadre_info').value=data[0];
    document.getElementById('txt_dni_madre_info').value=data[1];
    document.getElementById('txt_nacionalidad_madre_info').value=data[22];
    document.getElementById('txt_nombre_madre_info').value=data[2];
    document.getElementById('txt_genero_madre_info').value=data[23];
    document.getElementById('txt_fecha_madre_info').value=data[24];
    document.getElementById('txt_ciudad_madre_info').value=data[3];
    document.getElementById('txt_direccion_madre_info').value=data[4];
    document.getElementById('txt_correo_madre_info').value=data[5];
    document.getElementById('txt_telefono_madre_info').value=data[6];
    //--
    document.getElementById('txt_idpadre_info').value=data[8];
    document.getElementById('txt_dni_padre_info').value=data[9];
    document.getElementById('txt_nacionalidad_padre_info').value=data[25];
    document.getElementById('txt_nombre_padre_info').value=data[10];
    document.getElementById('txt_genero_padre_info').value=data[26];
    document.getElementById('txt_fecha_padre_info').value=data[27];
    document.getElementById('txt_ciudad_padre_info').value=data[11];
    document.getElementById('txt_direccion_padre_info').value=data[12];
    document.getElementById('txt_correo_padre_info').value=data[13];
    document.getElementById('txt_telefono_padre_info').value=data[14];
    //--
    document.getElementById('txt_idapoderado_info').value=data[15];
    document.getElementById('txt_dni_apoderado_info').value=data[16];
    document.getElementById('txt_nacionalidad_apoderado_info').value=data[28];
    document.getElementById('txt_nombre_apoderado_info').value=data[17];
    document.getElementById('txt_genero_apoderado_info').value=data[29];
    document.getElementById('txt_parentesco_apoderado_info').value=data[30];
    document.getElementById('txt_fecha_apoderado_info').value=data[31];
    document.getElementById('txt_ciudad_apoderado_info').value=data[18];
    document.getElementById('txt_direccion_apoderado_info').value=data[19];
    document.getElementById('txt_correo_apoderado_info').value=data[20];
    document.getElementById('txt_telefono_apoderado_info').value=data[21];
})


function AbrirModalRegistroApoderado() {
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_registro_apoderado").modal({ backdrop: 'static', keyboard: false });
    $("#modal_registro_apoderado").modal('show');

}

function Registrar_Apoderado() {
    let dnimadre = document.getElementById('txt_dni_madre').value;
    let nacionalidadmadre = document.getElementById('txt_nacionalidad_madre').value;
    let nombremadre = document.getElementById('txt_nombre_madre').value;
    let generomadre = document.getElementById('txt_genero_madre').value;
    let parentescomadre = document.getElementById('txt_parentesco_madre').value;
    let nacimientomadre = document.getElementById('txt_fecha_madre').value;
    let ciudadmadre = document.getElementById('txt_ciudad_madre').value;
    let direccionmadre = document.getElementById('txt_direccion_madre').value;
    let correomadre = document.getElementById('txt_correo_madre').value;
    let telefonomadre = document.getElementById('txt_telefono_madre').value;
    //-----------------Registro del padre-------------------------------------
    let dnipadre = document.getElementById('txt_dni_padre').value;
    let nacionalidadpadre = document.getElementById('txt_nacionalidad_padre').value;
    let nombrepadre = document.getElementById('txt_nombre_padre').value;
    let generopadre = document.getElementById('txt_genero_padre').value;
    let parentescopadre = document.getElementById('txt_parentesco_padre').value;
    let nacimientopadre = document.getElementById('txt_fecha_padre').value;
    let ciudadpadre = document.getElementById('txt_ciudad_padre').value;
    let direccionpadre = document.getElementById('txt_direccion_padre').value;
    let correopadre = document.getElementById('txt_correo_padre').value;
    let telefonopadre = document.getElementById('txt_telefono_padre').value;
    //----------------Registro del apoderado--------------------------------
    let dniapoderado = document.getElementById('txt_dni_apoderado').value;
    let nacionalidadapoderado = document.getElementById('txt_nacionalidad_apoderado').value;
    let nombreapoderado = document.getElementById('txt_nombre_apoderado').value;
    let generoapoderado = document.getElementById('txt_genero_apoderado').value;
    let parentescoapoderado = document.getElementById('txt_parentesco_apoderado').value;
    let nacimientoapoderado = document.getElementById('txt_fecha_apoderado').value;
    let ciudadapoderado = document.getElementById('txt_ciudad_apoderado').value;
    let direccionapoderado = document.getElementById('txt_direccion_apoderado').value;
    let correoapoderado = document.getElementById('txt_correo_apoderado').value;
    let telefonoapoderado = document.getElementById('txt_telefono_apoderado').value;
   
    $.ajax({
        url: '../controller/apoderado/controlador_apoderado_registro.php',
        type: 'POST',
        data: {
          dnimadre:dnimadre,
          nacionalidadmadre:nacionalidadmadre,
          nombremadre:nombremadre,
          generomadre:generomadre,
          parentescomadre:parentescomadre,
          nacimientomadre:nacimientomadre,
          ciudadmadre:ciudadmadre,
          direccionmadre:direccionmadre,
          correomadre:correomadre,
          telefonomadre:telefonomadre,
          //-----------------
          dnipadre:dnipadre,
          nacionalidadpadre:nacionalidadpadre,
          nombrepadre:nombrepadre,
          generopadre:generopadre,
          parentescopadre:parentescopadre,
          nacimientopadre:nacimientopadre,
          ciudadpadre:ciudadpadre,
          direccionpadre:direccionpadre,
          correopadre:correopadre,
          telefonopadre:telefonopadre,
          //-----------------
          dniapoderado:dniapoderado,
          nacionalidadapoderado:nacionalidadapoderado,
          nombreapoderado:nombreapoderado,
          generoapoderado:generoapoderado,
          parentescoapoderado:parentescoapoderado,
          nacimientoapoderado:nacimientoapoderado,
          ciudadapoderado:ciudadapoderado,
          direccionapoderado:direccionapoderado,
          correoapoderado:correoapoderado,
          telefonoapoderado:telefonoapoderado
        }
    
    }).done(function(resp){
        if(isNaN(resp)){
            document.getElementById('div_mensaje_error').innerHTML='<br>'+
            '<div class="alert alert-danger alert-dismissible">'+
                '<h5><i class="icon fas fa-ban"></i> Atención!</h5>'+
                resp+'</div>';
        }else{
            if (resp > 0) {
                if(resp==1){
                    LimpiarModalApoderado();
                    Swal.fire("Mensaje de Confirmación", "Registro de padres-apoderado exitoso!",
                        "success").then((value) => {
                            $("#modal_registro_apoderado").modal('hide');
                            tbl_apoderado_simple.ajax.reload();
                        });
                }else{
                    Swal.fire("ERROR", "El apoderado ya se encuentra registrado en la base de datos",
                    "error");
                }
            } else {
                Swal.fire("Mensaje de Error", "Registro fallido",
                    "error");
            }
        } 
    })
}

function ValidarInput(dni, nacionalidad, nombre, genero, nacimiento, ciudad, direccion,telefono) {
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

    Boolean(document.getElementById(telefono).value.length > 0) ? $("#" + telefono).
    removeClass("is-invalid").addClass("is-valid") : $("#" + telefono).removeClass
    ("is-valid").addClass("is-invalid");
}
function LimpiarModalApoderado() {
    document.getElementById('txt_dni_madre').value="";
    document.getElementById('txt_nombre_madre').value="";
    document.getElementById('txt_fecha_madre').value="";
    document.getElementById('txt_ciudad_madre').value="";
    document.getElementById('txt_direccion_madre').value="";
    document.getElementById('txt_correo_madre').value="";
    document.getElementById('txt_telefono_madre').value="";
    //---
    document.getElementById('txt_dni_padre').value="";
    document.getElementById('txt_nombre_padre').value="";
    document.getElementById('txt_fecha_padre').value="";
    document.getElementById('txt_ciudad_padre').value="";
    document.getElementById('txt_direccion_padre').value="";
    document.getElementById('txt_correo_padre').value="";
    document.getElementById('txt_telefono_padre').value="";
    //--
    document.getElementById('txt_dni_apoderado').value="";
    document.getElementById('txt_nombre_apoderado').value="";
    document.getElementById('txt_fecha_apoderado').value="";
    document.getElementById('txt_ciudad_apoderado').value="";
    document.getElementById('txt_direccion_apoderado').value="";
    document.getElementById('txt_correo_apoderado').value="";
    document.getElementById('txt_telefono_apoderado').value="";
}

function Modificar_Apoderado(){
    let idmadre = document.getElementById('txt_idmadre_editar').value;
    let nombremadre = document.getElementById('txt_nombre_madre_editar').value;
    let nacimientomadre = document.getElementById('txt_fecha_madre_editar').value;
    let ciudadmadre = document.getElementById('txt_ciudad_madre_editar').value;
    let direccionmadre = document.getElementById('txt_direccion_madre_editar').value;
    let correomadre = document.getElementById('txt_correo_madre_editar').value;
    let telefonomadre = document.getElementById('txt_telefono_madre_editar').value;
    //-----------------Registro del padre-------------------------------------
    let idpadre = document.getElementById('txt_idpadre_editar').value;
    let nombrepadre = document.getElementById('txt_nombre_padre_editar').value;
    let nacimientopadre = document.getElementById('txt_fecha_padre_editar').value;
    let ciudadpadre = document.getElementById('txt_ciudad_padre_editar').value;
    let direccionpadre = document.getElementById('txt_direccion_padre_editar').value;
    let correopadre = document.getElementById('txt_correo_padre_editar').value;
    let telefonopadre = document.getElementById('txt_telefono_padre_editar').value;
    //----------------Registro del apoderado--------------------------------
    let idapoderado = document.getElementById('txt_idapoderado_editar').value;
    let dniapoderado = document.getElementById('txt_dni_apoderado_editar').value;
    let nombreapoderado = document.getElementById('txt_nombre_apoderado_editar').value;
    let parentescoapoderado = document.getElementById('txt_parentesco_apoderado_editar').value;
    let nacimientoapoderado = document.getElementById('txt_fecha_apoderado_editar').value;
    let ciudadapoderado = document.getElementById('txt_ciudad_apoderado_editar').value;
    let direccionapoderado = document.getElementById('txt_direccion_apoderado_editar').value;
    let correoapoderado = document.getElementById('txt_correo_apoderado_editar').value;
    let telefonoapoderado = document.getElementById('txt_telefono_apoderado_editar').value;
    
    $.ajax({
        url: '../controller/apoderado/controlador_apoderado_modificar.php',
        type: 'POST',
        data: {
           idmadre:idmadre,
           nombremadre:nombremadre,
           nacimientomadre:nacimientomadre,
           ciudadmadre:ciudadmadre,
           direccionmadre:direccionmadre,
           correomadre:correomadre,
           telefonomadre:telefonomadre,
           idpadre:idpadre,
           nombrepadre:nombrepadre,
           nacimientopadre:nacimientopadre,
           ciudadpadre:ciudadpadre,
           direccionpadre:direccionpadre,
           correopadre:correopadre,
           telefonopadre:telefonopadre,
           idapoderado:idapoderado,
           dniapoderado:dniapoderado,
           nombreapoderado:nombreapoderado,
           parentescoapoderado:parentescoapoderado,
           nacimientoapoderado:nacimientoapoderado,
           ciudadapoderado:ciudadapoderado,
           direccionapoderado:direccionapoderado,
           correoapoderado:correoapoderado,
           telefonoapoderado:telefonoapoderado
        }
    
    }).done(function(resp){ 
        if (resp > 0) {
                Swal.fire("MENSAJE", "APODERADO MODIFICADO",
                    "success").then((value) => {
                        $("#modal_editar_apoderado").modal('hide');
                        tbl_apoderado_simple.ajax.reload();
                    });

        } else {
            Swal.fire("Mensaje de Error", "No se pudo actualizar los datos",
                "error");
        }
    })
}

function Modificar_Estatus(id,estado){
    $.ajax({
        url: '../controller/apoderado/controlador_modificar_apoderado_estatus.php',
        type: 'POST',
        data: {
          id:id,
          estado:estado
        }
    
    }).done(function(resp){ 
        if (resp > 0) {
                Swal.fire("Mensaje de Confirmación", "Registro de Padres y/o Apoderados eliminados",
                    "success").then((value) => {
                        tbl_apoderado_simple.ajax.reload();
                    });

        } else {
            Swal.fire("Mensaje de Error", "No se pudo eliminar los registros",
                "error");
        }
    })
}

$('#tabla_apoderado_simple').on('click','.desactivar',function() {
    var data = tbl_apoderado_simple.row($(this).parents('tr')).data();

    if(tbl_apoderado_simple.row(this).child.isShown()){
        var data = tbl_apoderado_simple.row(this).data();
    }
    Swal.fire({
        title: 'Está seguro de eliminar?',
        text: "Esta acción no se puede revertir!",
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

var botonLimpiar = document.getElementById("btnlimpiar");
var inputNombre = document.getElementById("txt_nombre_apoderado_editar");
var inputDni = document.getElementById("txt_dni_apoderado_editar");
var inputParentesco = document.getElementById("txt_parentesco_apoderado_editar");
var inputNacimiento = document.getElementById("txt_fecha_apoderado_editar");
var inputDireccion = document.getElementById("txt_direccion_apoderado_editar");
var inputCorreo = document.getElementById("txt_direccion_apoderado_editar");
var inputTelefono = document.getElementById("txt_telefono_apoderado_editar");

botonLimpiar.addEventListener("click", function() {
        inputNombre.value = "";
        inputDni.value = "";
        inputParentesco.value = "";
        inputNacimiento.value = "";
        inputDireccion.value = "";
        inputCorreo.value = "";
        inputTelefono.value = "";
});

