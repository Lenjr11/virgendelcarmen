//alertaPersonalizada('success', 'Bienvenido al sistema login!');

const fmr = document.querySelector("#formulario");
const usuari_usuario = document.querySelector("#usuari_usuario");
const usuari_clave = document.querySelector("#usuari_clave");

document.addEventListener("DOMContentLoaded", function () {
  fmr.addEventListener("submit", function (e) {
    e.preventDefault();
    console.log(usuari_usuario.value);
    console.log(usuari_clave.value);
    if (usuari_usuario.value == "" || usuari_clave.value == "") {
      alertaPersonalizada("warning", "Hay campos vacios!");
    } else {
      const data = new FormData(fmr);
      const http = new XMLHttpRequest();

      const url = base_url + "principal/validar";

      http.open("POST", url, true);

      http.send(data);

      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          alertaPersonalizada(res.tipo, res.mensaje);
          if (res.tipo == 'success' ) {
            Swal.fire({
              title: res.mensaje,
              html: 'Ingresando en <b></b> milliseconds.',
              timer: 1000,
              timerProgressBar: true,
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
                window.location = base_url + 'admin'; 
              }
            })
            
          }
        }
      };
    }
  });
});
