function Iniciar_Sesion() {
    let usu = document.getElementById('txt_usuario').value;
    let pass = document.getElementById('txt_pass').value;
    if (usu.length == 0 || pass.length == 0) {
        return Swal.fire('Importante', 'Completar los espacios en blanco',
            'warning');
    }
    $.ajax({
        url: 'controller/usuario/iniciar_sesion.php',
        type: 'POST',
        data: {
            u: usu,
            p: pass
        }
    }).done(function (resp) {
        let data = JSON.parse(resp);
        if (data.length > 0) {
            if (data[0][8] == 'INACTIVO') {
                return Swal.fire('Mensaje de advertencia', 'lo sentimos, el usuario '
                    + usu + ' se encuentra desactivo, comuniquese con el administrador',
                    'warning');
            }

            if (data[0][11] == 2) {
                return Swal.fire('ERROR', 'Se ha bloqueado su cuenta por llegar al límite de intentos fallidos, comuniquese con el administrador',
                    'warning');
            }

            $.ajax({
                url: 'controller/usuario/crear_sesion.php',
                type: 'POST',
                data: {
                    idusuario: data[0][0],
                    usuario: data[0][3],
                    rol: data[0][9]
                }
            }).done(function (r) {
                let timerInterval
                Swal.fire({
                    title: 'Bienvenido al sistema',
                    html: 'Será redireccionado en <b></b> milisegundos.',
                    timer: 1500,
                    heightAuto: false,
                    timerProgressBar: true,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        location.reload();
                    }
                })
            })

        } else {
            $.ajax({
                url: 'controller/usuario/controlador_intento_modificar.php',
                type: 'POST',
                data: {
                    user: usu
                }
            }).done(function(resp){
                Swal.fire('ERROR', 'Usuario o contraseña incorrecta, intentos fallidos: '+(parseInt(resp)+1)+' <b>*Recuerde que si llega a los 3 intentos la cuenta se bloqueará*</b>',
                    'warning');
            })
        }
    })
}

var tbl_usuario_simple;
function listar_usuario_simple() {
    tbl_usuario_simple = $("#tabla_usuario_simple").DataTable({
        "ordering": false,
        "blengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLenght": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controller/usuario/controlador_usuario_listar.php",
            type: 'POST'
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "usuari_nombre" },
            { "data": "usuari_apellidos" },
            { "data": "usuari_usuario" },
            { "data": "usuari_correo" },
            {"data": "usuari_estado",
                render: function (data, type, row) {
                    if (data == '1') {
                        return '<span class="badge bg-success text-white">ACTIVO</span>';
                    } else {
                        return '<span class="badge bg-danger">INACTIVO</span>';
                    }
                }
            },
            { "defaultContent": "<button class='btn btn-primary'><i class='fa fa-edit'></i></button>" },
        ],

        "language": idioma_espanol,
        select: true
    });
    tbl_usuario_simple.on('draw.td', function () {
        var PageInfo = $("#tabla_usuario_simple").DataTable().page.info();
        tbl_usuario_simple.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
}

var tbl_usuario_simple;
function listar_usuario_serverside() {
    tbl_usuario_simple = $("#tabla_usuario_simple").DataTable({
        "pageLenght": 10,
        "destroy": true,
        "bProcessing": true,
        "bDeferRender": true,
        "bServerSide": true,
        "sAjaxSource": "../controller/usuario/serverside/serversideUsuario.php",
        "columns": [
            { "defaultContent": "" },
            { "data": 1 },
            { "data": 7 },
            { "data": 2 },
            { "data": 5 },
            {"data": 6,
                render: function (data, type, row) {
                    if (data == 'ACTIVO') {
                        return '<span class="badge bg-success text-white">ACTIVO</span>';
                    } else {
                        return '<span class="badge bg-danger text-white">INACTIVO</span>';
                    }
                }
            },
            {"data": 6,
                render: function(data, type, row) {
                    if (data=='ACTIVO'){
                    return "<button class='editar btn btn-primary btn-sm'><i class='fa fa-edit'></i></button>&nbsp;<button class='btn btn-success btn-sm' disabled><i class='fa fa-check-circle'></i></button>&nbsp;<button class='desactivar btn btn-danger btn-sm'><i class='fa fa-ban'></i></button>&nbsp;<button class='contra btn btn-secondary btn-sm'><i class='fa fa-key'></i></button>&nbsp;<button class='resetar btn btn-warning btn-sm'><i class='fa fa-unlock'></i></button>";
                }else{
                    return "<button class='editar btn btn-primary btn-sm'><i class='fa fa-edit'></i></button>&nbsp;<button class='activar btn btn-success btn-sm'><i class='fa fa-check-circle'></i></button>&nbsp;<button class='btn btn-danger btn-sm' disabled><i class='fa fa-ban'></i></button>&nbsp;<button class='contra btn btn-secondary btn-sm'><i class='fa fa-key'></i></button>&nbsp;<button class='resetar btn btn-warning btn-sm'><i class='fa fa-unlock'></i></button>";
                }
                }
            },
        ],

        "language": idioma_espanol,
        select: true
    });
    tbl_usuario_simple.on('draw.td',function(){
        var PageInfo = $("#tabla_usuario_simple").DataTable().page.info();
        tbl_usuario_simple.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
}

$('#tabla_usuario_simple').on('click','.editar',function() {
    var data = tbl_usuario_simple.row($(this).parents('tr')).data();

    if(tbl_usuario_simple.row(this).child.isShown()){
        var data = tbl_usuario_simple.row(this).data();
    }

    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_editar_usuario").modal('show');
    document.getElementById('txt_idusuario_editar').value=data[0];
    document.getElementById('txt_nombre_editar').value=data[1];
    document.getElementById('txt_apellido_editar').value=data[8];
    document.getElementById('txt_usuario_editar').value=data[2];
    document.getElementById('txt_email_editar').value=data[7];
    document.getElementById('txt_telefono_editar').value=data[9];
    $("#select_rol_editar").select().val(data[4]).trigger('change.select2');
})

$('#tabla_usuario_simple').on('click','.activar',function() {
    var data = tbl_usuario_simple.row($(this).parents('tr')).data();

    if(tbl_usuario_simple.row(this).child.isShown()){
        var data = tbl_usuario_simple.row(this).data();
    }
    Swal.fire({
        title: 'Está seguro de activar el estado del usuario <b>'+data[1]+'</b>?',
        text: "Una vez realizado esto, el usuario tendrá acceso al sistema!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, continuar!'
      }).then((result) => {
        if (result.isConfirmed) {
            Modificar_Estatus(data[0],"ACTIVO");
        }
      })
})

$('#tabla_usuario_simple').on('click','.desactivar',function() {
    var data = tbl_usuario_simple.row($(this).parents('tr')).data();

    if(tbl_usuario_simple.row(this).child.isShown()){
        var data = tbl_usuario_simple.row(this).data();
    }
    Swal.fire({
        title: 'Está seguro de desactivar el estado del usuario <b>'+data[1]+'</b>?',
        text: "Una vez realizado esto, el usuario no tendrá acceso al sistema!",
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

$('#tabla_usuario_simple').on('click','.contra',function() {
    var data = tbl_usuario_simple.row($(this).parents('tr')).data();

    if(tbl_usuario_simple.row(this).child.isShown()){
        var data = tbl_usuario_simple.row(this).data();
    }

    $("#modal_editar_contra").modal('show');
    document.getElementById('idusuariocontra').value=data[0];
    document.getElementById('lbl_usuario_contra').innerHTML=data[1];
})

function AbrirModalRegistroUsuario() {
    $('.form-control').removeClass("is-invalid").removeClass("is-valid");
    $("#modal_registro_usuario").modal({ backdrop: 'static', keyboard: false });
    $("#modal_registro_usuario").modal('show');

}

function cargar_select_rol() {
    $.ajax({
        url: '../controller/usuario/controlador_cargar_select_rol.php',
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

            document.getElementById('select_rol').innerHTML = llenardata;
            document.getElementById('select_rol_editar').innerHTML = llenardata;
        } else {
            llenardata += "<option value=''>No se encontraron datos en la bd</option>";
            document.getElementById('select_rol').innerHTML = llenardata;
            document.getElementById('select_rol_editar').innerHTML = llenardata;
        }
    })
}

function Registrar_Usuario() {
    let nombre = document.getElementById('txt_nombre').value;
    let apellido = document.getElementById('txt_apellido').value;
    let usuario = document.getElementById('txt_usuario').value;
    let email = document.getElementById('txt_email').value;
    let contra = document.getElementById('txt_contra').value;
    let telefono = document.getElementById('txt_telefono').value;
    let fecha = document.getElementById('txt_fecha').value;
    let rol = document.getElementById('select_rol').value;
    if (nombre.length == 0 || apellido.length == 0 || usuario.length == 0 || email.length == 0 || contra.length == 0 || telefono.length == 0 || fecha.length == 0 || rol.length == 0) {
        ValidarInput("txt_nombre", "txt_apellido", "txt_usuario", "txt_email", "txt_contra", "txt_telefono", "txt_fecha");
        return Swal.fire("Error", "Todos los campos son obligatorios",
            "warning");
    }

    if (validar_email(email)) {

    } else {
        return Swal.fire("Error", "El formato ingresado del email es incorrecto",
            "warning");
    }
    let formData = new FormData();
    formData.append('n', nombre);
    formData.append('a', apellido);
    formData.append('u', usuario);
    formData.append('e', email);
    formData.append('c', contra);
    formData.append('t', telefono);
    formData.append('f', fecha);
    formData.append('r', rol);
    $.ajax({
        url: '../controller/usuario/controlador_usuario_registro.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (resp) {
            if(isNaN(resp)){
                document.getElementById('div_mensaje_error').innerHTML='<br>'+
                '<div class="alert alert-danger alert-dismissible">'+
                    '<h5><i class="icon fas fa-ban"></i> Revise los siguientes campos!</h5>'+
                    resp+'</div>';
            }else{
                if(resp>0){
                    if (resp == 1) {
                        ValidarInput("txt_nombre", "txt_apellido", "txt_usuario", "txt_email", "txt_contra", "txt_telefono", "txt_fecha");
                        LimpiarModalUsuario();
                        Swal.fire("Mensaje de Confirmación", "Registro exitoso!",
                            "success").then((value) => {
                                $("#modal_registro_usuario").modal('hide');
                                tbl_usuario_simple.ajax.reload();
                            });
                    } else {
                        Swal.fire("Mensaje de Advertencia", "El usuario ya se encuentra registrado",
                            "warning");
                    }
                } else {
                    Swal.fire("Mensaje de Error", "No se pudo registrar el usuario",
                        "error");
                }
            }
        }
    });
    return false;
}

function ValidarInput(nombre, apellido, usuario, email, contra, telefono, fecha) {
    Boolean(document.getElementById(nombre).value.length > 0) ? $("#" + nombre).
    removeClass("is-invalid").addClass("is-valid") : $("#" + nombre).removeClass
    ("is-valid").addClass("is-invalid");

    Boolean(document.getElementById(apellido).value.length > 0) ? $("#" + apellido).
    removeClass("is-invalid").addClass("is-valid") : $("#" + apellido).removeClass
    ("is-valid").addClass("is-invalid");

    Boolean(document.getElementById(usuario).value.length > 0) ? $("#" + usuario).
    removeClass("is-invalid").addClass("is-valid") : $("#" + usuario).removeClass
    ("is-valid").addClass("is-invalid");

    Boolean(document.getElementById(email).value.length > 0) ? $("#" + email).
    removeClass("is-invalid").addClass("is-valid") : $("#" + email).removeClass
    ("is-valid").addClass("is-invalid");

    if(contra !=""){
        Boolean(document.getElementById(contra).value.length > 0) ? $("#" + contra).
    removeClass("is-invalid").addClass("is-valid") : $("#" + contra).removeClass
    ("is-valid").addClass("is-invalid");
    }

    Boolean(document.getElementById(telefono).value.length > 0) ? $("#" + telefono).
    removeClass("is-invalid").addClass("is-valid") : $("#" + telefono).removeClass
    ("is-valid").addClass("is-invalid");

    Boolean(document.getElementById(fecha).value.length > 0) ? $("#" + fecha).
    removeClass("is-invalid").addClass("is-valid") : $("#" + fecha).removeClass
    ("is-valid").addClass("is-invalid");
}

function validar_email(email) {
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
}

function LimpiarModalUsuario() {
    document.getElementById('txt_nombre').value="";
    document.getElementById('txt_apellido').value="";
    document.getElementById('txt_usuario').value="";
    document.getElementById('txt_email').value="";
    document.getElementById('txt_contra').value="";
    document.getElementById('txt_telefono').value="";
    document.getElementById('txt_fecha').value="";
    document.getElementById('select_rol').value="";
}

function Modificar_Usuario(){
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

function Modificar_Estatus(id,estado){
    $.ajax({
        url: '../controller/usuario/controlador_modificar_usuario_estatus.php',
        type: 'POST',
        data: {
          id:id,
          estado:estado
        }
    
    }).done(function(resp){ 
        if (resp > 0) {
                Swal.fire("Mensaje de Confirmación", "Se cambió el estatus correctamente",
                    "success").then((value) => {
                        tbl_usuario_simple.ajax.reload();
                    });

        } else {
            Swal.fire("Mensaje de Error", "No se pudo cambiar el estatus",
                "error");
        }
    })
}

function Modificar_Contra_Usuario(){
    let id = document.getElementById('idusuariocontra').value;
    let contranueva = document.getElementById('txt_contra_nueva').value;
    let contrarepetir = document.getElementById('txt_contra_repetir').value;
    if (id.length == 0 || contranueva.length == 0 || contrarepetir.length == 0) {
        return Swal.fire("ERROR", "Tiene algunos campos vacios",
            "warning");
    }
    if (contranueva != contrarepetir) {
        return Swal.fire("ERROR", "Las contraseñas no coinciden",
            "warning");
    }
    $.ajax({
        url: '../controller/usuario/controlador_modificar_usuario_contra.php',
        type: 'POST',
        data: {
          id:id,
          contranueva:contranueva
        }
    
    }).done(function(resp){ 
        if (resp > 0) {
                Swal.fire("Mensaje de Confirmación", "Contraseña actualizada",
                    "success").then((value) => {
                        document.getElementById('txt_contra_nueva').value+"";
                        document.getElementById('txt_contra_repetir').value+"";
                        $("#modal_editar_contra").modal('hide');
                        tbl_usuario_simple.ajax.reload();
                    });

        } else {
            Swal.fire("Mensaje de Error", "No se pudo cambiar la contraseña",
                "error");
        }
    })
}

$('#tabla_usuario_simple').on('click','.resetar',function() {
    var data = tbl_usuario_simple.row($(this).parents('tr')).data();

    if(tbl_usuario_simple.row(this).child.isShown()){
        var data = tbl_usuario_simple.row(this).data();
    }
    Swal.fire({
        title: 'Está seguro de resetar los intentos del usuario <b>'+data[1]+'</b>?',
        text: "Una vez realizado esto, los intentos del usuario vuelven a 0!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, continuar!'
      }).then((result) => {
        if (result.isConfirmed) {
            Modificar_Intentos(data[0],0);
        }
      })
})

function Modificar_Intentos(id,intento){
    $.ajax({
        url: '../controller/usuario/controlador_modificar_intentos.php',
        type: 'POST',
        data: {
          id:id,
          intento:intento
        }
    
    }).done(function(resp){ 
        if (resp > 0) {
            Swal.fire("Mensaje de Error", "No se pudo resetear los intentos",
                "error");

        } else {
            Swal.fire("Mensaje de Confirmación", "Se resetearon los intentos de usuario!",
                    "success").then((value) => {
                        tbl_usuario_simple.ajax.reload();
                    });
        }
    })
}