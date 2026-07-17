document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".btn-eliminar").forEach(function (boton) {
    boton.addEventListener("click", function (evento) {
      var confirmado = confirm("¿Seguro que quieres eliminar esto? Esta acción no se puede deshacer.");
      if (!confirmado) {
        evento.preventDefault();
      }
    });
  });
 
  document.querySelectorAll("[data-buscar-tabla]").forEach(function (input) {
    var idTabla = input.getAttribute("data-buscar-tabla");
    var tabla = document.getElementById(idTabla);
    if (!tabla) return;
 
    var filas = tabla.querySelectorAll("tbody tr");
 
    input.addEventListener("input", function () {
      var termino = input.value.trim().toLowerCase();
      filas.forEach(function (fila) {
        var texto = fila.textContent.toLowerCase();
        fila.style.display = texto.includes(termino) ? "" : "none";
      });
    });
  });
 
  document.querySelectorAll(".admin-tabla").forEach(function (tabla) {
    var encabezados = tabla.querySelectorAll("thead th");
 
    encabezados.forEach(function (encabezado, indiceColumna) {
      encabezado.style.cursor = "pointer";
      encabezado.title = "Clic para ordenar";
 
      encabezado.addEventListener("click", function () {
        var tbody = tabla.querySelector("tbody");
        var filas = Array.prototype.slice.call(tbody.querySelectorAll("tr"));
        var ordenActual = tabla.getAttribute("data-orden");
        var claveNueva = "asc-" + indiceColumna;
        var ascendente = ordenActual !== claveNueva;
 
        filas.sort(function (filaA, filaB) {
          var textoA = filaA.children[indiceColumna].textContent.trim().toLowerCase();
          var textoB = filaB.children[indiceColumna].textContent.trim().toLowerCase();
 
          var numeroA = parseFloat(textoA.replace(/[^0-9.\-]/g, ""));
          var numeroB = parseFloat(textoB.replace(/[^0-9.\-]/g, ""));
          var sonNumeros = !isNaN(numeroA) && !isNaN(numeroB) && textoA !== "" && textoB !== "";
 
          if (sonNumeros) {
            return ascendente ? numeroA - numeroB : numeroB - numeroA;
          }
          return ascendente ? textoA.localeCompare(textoB) : textoB.localeCompare(textoA);
        });
 
        filas.forEach(function (fila) {
          tbody.appendChild(fila);
        });
 
        tabla.setAttribute("data-orden", ascendente ? claveNueva : "desc-" + indiceColumna);
      });
    });
  });
 
  document.querySelectorAll(".admin-tabla select[name='estado']").forEach(function (select) {
    function actualizarColorEstado() {
      select.classList.remove(
        "estado-select-recibido",
        "estado-select-preparando",
        "estado-select-listo",
        "estado-select-entregado"
      );
      select.classList.add("estado-select-" + select.value);
    }
 
    select.addEventListener("change", actualizarColorEstado);
    actualizarColorEstado();
  });

  var botonArriba = document.createElement("button");
  botonArriba.id = "btn-arriba";
  botonArriba.setAttribute("aria-label", "Volver arriba");
  botonArriba.innerHTML = "&#8593;";
  document.body.appendChild(botonArriba);
 
  window.addEventListener("scroll", function () {
    botonArriba.classList.toggle("visible", window.scrollY > 400);
  });
 
  botonArriba.addEventListener("click", function () {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });
});
 