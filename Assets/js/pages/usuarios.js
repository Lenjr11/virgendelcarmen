const frm = document.querySelector("#formulario");
const btnNuevo = document.querySelector("#btnNuevo");
const title = document.querySelector("#title");

const modalRegistro = document.querySelector("#modalRegistro");

const myModal = new bootstrap.Modal(modalRegistro);

let tblUsuarios;

document.addEventListener("DOMContentLoaded", function () {
  //Cargar daros con DATATABLE
  tblUsuarios = $("#tblUsuarios").DataTable({
    ajax: {
      url: base_url + "usuarios/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id_usuario" },
      { data: "usuari_nombre" },
      { data: "usuari_apellidos" },
      { data: "usuari_usuario" },
      { data: "usuari_telefono" },
      { data: "usuari_direccion" },
      { data: "usuari_fecha" },
      {
        data: "usuari_estado",
        render: function (data, type, row) {
          if (data == "1") {
            return '<span class="badge bg-success">ACTIVO</span>';
          } else {
            return '<span class="badge bg-danger">INACTIVO</span>';
          }
        },
      },
      { data: "usuari_rol" },
      { data: "acciones" },
    ],
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json",
    },
    order: [[0, "desc"]],
  });
  btnNuevo.addEventListener("click", function () {
    title.textContent = "NUEVO USUARIO";
    frm.idusuario.value = "";
    frm.reset();
    frm.contrasena.removeAttribute("readonly");
    myModal.show();
  });
  //Registrar usuario por ajax
  frm.addEventListener("submit", function (e) {
    e.preventDefault();
    if (
      frm.nombre.value == "" ||
      frm.apellido.value == "" ||
      frm.usuario.value == "" ||
      frm.contrasena.value == "" ||
      frm.telefono.value == "" ||
      frm.direccion.value == "" ||
      frm.fecha.value == "" ||
      frm.estado.value == "" ||
      frm.rol.value == ""
    ) {
      alertaPersonalizada("warning", "TODOS LOS CAMPOS SON OBLIGATORIOS");
    } else {
      const data = new FormData(frm);
      const http = new XMLHttpRequest();

      const url = base_url + "usuarios/guardar";

      http.open("POST", url, true);

      http.send(data);

      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertaPersonalizada(res.tipo, res.mensaje);
          if (res.tipo == "success") {
            frm.reset();
            myModal.hide();
            tblUsuarios.ajax.reload();
          }
        }
      };
    }
  });
});

function eliminar(id_usuario) {
  const url = base_url + "usuarios/delete/" + id_usuario;
  eliminarRegistro(
    "Seguro que quiere eliminar",
    "",
    "Si, eliminar",
    url,
    tblUsuarios
  );
}

function editar(id_usuario) {
  const http = new XMLHttpRequest();

  const url = base_url + "usuarios/editar/" + id_usuario;

  http.open("GET", url, true);

  http.send();

  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      title.textContent = "EDITAR USUARIO";
      frm.idusuario.value = res.id_usuario;
      frm.nombre.value = res.usuari_nombre;
      frm.apellido.value = res.usuari_apellidos;
      frm.usuario.value = res.usuari_usuario;
      frm.contrasena.value = "00000000";
      frm.contrasena.setAttribute("readonly", "readonly");
      frm.telefono.value = res.usuari_telefono;
      frm.direccion.value = res.usuari_direccion;
      frm.fecha.value = res.usuari_fecha;
      frm.estado.value = res.usuari_estado;
      frm.rol.value = res.usuari_rol;
      myModal.show();
    }
  };
}
