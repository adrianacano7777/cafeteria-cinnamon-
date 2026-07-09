document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".btn-eliminar").forEach(function (boton) {
    boton.addEventListener("click", function (evento) {
      var confirmado = confirm("¿Seguro que quieres eliminar esto? Esta acción no se puede deshacer.");
      if (!confirmado) {
        evento.preventDefault();
      }
    });
  });
});