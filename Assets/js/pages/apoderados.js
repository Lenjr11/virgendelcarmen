const frm = document.querySelector("#formularioapoderado");
const btnApoderado = document.querySelector("#btnApoderado");
const title = document.querySelector("#title");

const modalApoderados = document.querySelector("#modalApoderados");

const myModal = new bootstrap.Modal(modalApoderados);

let tblApoderados;

document.addEventListener("DOMContentLoaded", function () {
  //Cargar daros con DATATABLE
  tblApoderados = $("#tblApoderados").DataTable({
    scrollX: true,
    ajax: {
      url: base_url + "apoderados/listar",
      dataSrc: "",
    },
    columns: [
      { data: "apoder_dni_ce" },
      { data: "apoder_nacionalidad" },
      { data: "apoder_nombre" },
      { data: "apoder_apellido" },
      { data: "apoder_nacimiento" },
      { data: "apoder_direccion" },
      { data: "apoder_correo" },
      { data: "apoder_telcel" },
      { data: "apoder_rol" },
      { data: "acciones" },
    ],
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json",
    },
    order: [[0, "desc"]],
  });
  btnApoderado.addEventListener("click", function () {
    title.textContent = "NUEVO APODERADO";
    frm.reset();
    myModal.show();
  });
  //Registrar usuario por ajax
  frm.addEventListener("submit", function (e) {
    e.preventDefault();
    if (
      frm.dni.value == "" ||
      frm.nacionalidad.value == "" ||
      frm.nombre.value == "" ||
      frm.apellido.value == "" ||
      frm.nacimiento.value == "" ||
      frm.direccion.value == "" ||
      frm.telcel.value == "" ||
      frm.parentesco.value == ""
    ) {
      alertaPersonalizada("warning", "TODOS LOS CAMPOS SON OBLIGATORIOS");
    } else {
      const data = new FormData(frm);
      const http = new XMLHttpRequest();

      const url = base_url + "apoderados/guardar";

      http.open("POST", url, true);

      http.send(data);

      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertaPersonalizada(res.tipo, res.mensaje);
          if (res.tipo == "success") {
            frm.reset();
            myModal.hide();
            tblApoderados.ajax.reload();
          }
        }
      };
    }
  });
});

function eliminar(apoder_dni_ce) {
  const url = base_url + "apoderados/delete/" + apoder_dni_ce;
  eliminarRegistro(
    "Seguro que quiere eliminar",
    "",
    "Si, eliminar",
    url,
    tblApoderados
  );
}

function editar(apoder_dni_ce) {
  const http = new XMLHttpRequest();

  const url = base_url + "apoderados/editar/" + apoder_dni_ce;

  http.open("GET", url, true);

  http.send();

  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      title.textContent = "EDITAR USUARIO";
      frm.dni.value = res.apoder_dni_ce;
      frm.nacionalidad.value = res.apoder_nacionalidad;
      frm.nombre.value = res.apoder_nombre;
      frm.apellido.value = res.apoder_apellido;
      frm.nacimiento.value = res.apoder_nacimiento;
      frm.direccion.value = res.apoder_direccion;
      frm.correo.value = res.apoder_correo;
      frm.telcel.value = res.apoder_telcel;
      frm.parentesco.value = res.apoder_rol;
      myModal.show();
    }
  };
}
