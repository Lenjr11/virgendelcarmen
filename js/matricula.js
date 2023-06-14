var tbl_matricula_simple;
function listar_matricula_serverside() {
    tbl_matricula_simple = $("#tabla_matricula_simple").DataTable({
        scrollX: true,
        "pageLenght": 10,
        "destroy": true,
        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
        "sAjaxSource": "../controller/matricula/serverside/serversideMatricula.php",
        "columns": [
            { "defaultContent": "" },
            { "data": 4 },
            { "data": 2 },
            { "data": 3 },
            { "data": 6 },
            { "data": 7 },
            { "data": 8 },
            {"data": 13,
                render: function(data, type, row) {
                    if (data=='ACTIVO'){
                    return "<button class='info btn btn-info btn-sm'><i class='fa fa-info'></i></button>&nbsp;<button class='editar btn btn-success btn-sm'><i class='fa fa-money-bill'></i></button>&nbsp;<button class='desactivar btn btn-danger btn-sm'><i class='fa fa-trash'></i></button>";
                }else{
                    return "<button class='info btn btn-info btn-sm'><i class='fa fa-info'></i></button>&nbsp;<button class='editar btn btn-success btn-sm'><i class='fa fa-money-bill'></i></button>&nbsp;<button class='desactivar btn btn-danger btn-sm'><i class='fa fa-trash'></i></button>";
                }
                }
            },
        ],

        "language": idioma_espanol,
        select: true
    });
    tbl_matricula_simple.on('draw.td',function(){
        var PageInfo = $("#tabla_matricula_simple").DataTable().page.info();
        tbl_matricula_simple.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
}


function AbrirModalRegistroMatricula() {
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_registro_matricula").modal({ backdrop: 'static', keyboard: false });
    $("#modal_registro_matricula").modal('show');

}

function LimpiarModalMatricula() {
    document.getElementById('txt_procedencia_matricula').value="";
    document.getElementById('txt_costo_matricula').value="";
    document.getElementById('txt_mensualidad_matricula').value="";
    document.getElementById('txt_descuento_matricula').value="";
    document.getElementById('txt_registro_matricula').value="";
}

function Registrar_Matricula() {
    let dni = document.getElementById('select_dni').value;
    let dniapoderado = document.getElementById('select_dni_apoderado').value;
    let grado = document.getElementById('select_grado').value;
    let situacion = document.getElementById('txt_situacion_matricula').value;
    let procedencia = document.getElementById('txt_procedencia_matricula').value;
    let cmatricula = document.getElementById('txt_costo_matricula').value;
    let cmensualidad = document.getElementById('txt_mensualidad_matricula').value;
    let descuento = document.getElementById('txt_descuento_matricula').value;
    let fecha = document.getElementById('txt_registro_matricula').value;
    if (dni.length == 0 || dniapoderado.length == 0 || grado.length == 0 || situacion.length == 0 || cmatricula.length == 0 || cmensualidad.length == 0 || fecha.length == 0) {
        return Swal.fire("Error", "Todos los campos requeridos son obligatorios",
            "warning");
    }if ( situacion.length == 'Ingresante' || procedencia.length == 0) {
        return Swal.fire("Error", "El/la estudiante es INGRESANTE, escriba el colegio de donde procede!",
            "warning");
    }
    $.ajax({
        url: '../controller/matricula/controlador_matricula_registro.php',
        type: 'POST',
        data: {
          dni:dni,
          dniapoderado:dniapoderado,
          grado:grado,
          situacion:situacion,
          procedencia:procedencia,
          cmatricula:cmatricula,
          cmensualidad:cmensualidad,
          descuento:descuento,
          fecha:fecha

        }
    
    }).done(function(resp){ 
        if (resp > 0) {
            if(resp==1){
                LimpiarModalMatricula();
                Swal.fire("MENSAJE", "Matricula Registrada",
                    "success").then((value) => {
                        $("#modal_registro_matricula").modal('hide');
                        tbl_matricula_simple.ajax.reload();
                    });
            }else{
                Swal.fire("ERROR", "Este Alumno ya se encuentra matriculado",
                "error");
            }
        } else {
            Swal.fire("Mensaje de Error", "Registro fallido",
                "error");
        }
    })
}

function cargar_select_dni() {
    $.ajax({
        url: '../controller/matricula/controlador_cargar_select_dni.php',
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

            document.getElementById('select_dni').innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos en la bd</option>";
            document.getElementById('select_dni').innerHTML = llenardata;
        }
    })
}

function cargar_select_dni_apoderado() {
    $.ajax({
        url: '../controller/matricula/controlador_cargar_select_dni_apoderado.php',
        type: 'POST'

    }).done(function (resp) {
        let data = JSON.parse(resp);
        let llenardata = "";
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                if (data[i][0] !="3"){
                   llenardata += "<option value='" + data[i][1] + "'>" + data[i][0] + "</option>";
                }
                
            }

            document.getElementById('select_dni_apoderado').innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos en la bd</option>";
            document.getElementById('select_dni_apoderado').innerHTML = llenardata;
        }
    })
}

function cargar_select_grado() {
    $.ajax({
        url: '../controller/matricula/controlador_cargar_select_grado.php',
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

            document.getElementById('select_grado').innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos en la bd</option>";
            document.getElementById('select_grado').innerHTML = llenardata;
        }
    })
}

$('#tabla_matricula_simple').on('click','.info',function() {
    var data = tbl_matricula_simple.row($(this).parents('tr')).data();

    if(tbl_matricula_simple.row(this).child.isShown()){
        var data = tbl_matricula_simple.row(this).data();
    }

    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_info_matricula").modal('show');
    document.getElementById('txt_codigo_mostrar').value=data[4];
    document.getElementById('txt_alumno_mostrar').value=data[2];
    document.getElementById('txt_apoderado_mostrar').value=data[3];
    document.getElementById('txt_grado_mostrar').value=data[6];
    document.getElementById('txt_situacion_mostrar').value=data[7];
    document.getElementById('txt_procedencia_mostrar').value=data[8];
    document.getElementById('txt_costomatri_mostrar').value=data[9];
    document.getElementById('txt_mensualidad_mostrar').value=data[10];
    document.getElementById('txt_descuento_mostrar').value=data[11];
    document.getElementById('txt_fecha_mostrar').value=data[12];
    document.getElementById('txt_total_mostrar').value=data[14];
})

$('#tabla_matricula_simple').on('click','.editar',function() {
    var data = tbl_matricula_simple.row($(this).parents('tr')).data();

    if(tbl_matricula_simple.row(this).child.isShown()){
        var data = tbl_matricula_simple.row(this).data();
    }

    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_historial_matricula").modal('show');
    document.getElementById('nombre_alumno').value=data[2];
    document.getElementById('nivel_alumno').value=data[6];
    document.getElementById('nom_apoder').value=data[3];
    document.getElementById('celular_apoder').value=data[14];
})

function Modificar_Estatus(id,estado){
    $.ajax({
        url: '../controller/matricula/controlador_modificar_matricula_estatus.php',
        type: 'POST',
        data: {
          id:id,
          estado:estado
        }
    
    }).done(function(resp){ 
        if (resp > 0) {
                Swal.fire("Mensaje de Confirmación", "Matrícula borrada",
                    "success").then((value) => {
                        tbl_matricula_simple.ajax.reload();
                    });

        } else {
            Swal.fire("Mensaje de Error", "No se pudo eliminar la matricula",
                "error");
        }
    })
}

$('#tabla_matricula_simple').on('click','.desactivar',function() {
    var data = tbl_matricula_simple.row($(this).parents('tr')).data();

    if(tbl_matricula_simple.row(this).child.isShown()){
        var data = tbl_matricula_simple.row(this).data();
    }
    Swal.fire({
        title: 'Está seguro de eliminar la matrícula?',
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








