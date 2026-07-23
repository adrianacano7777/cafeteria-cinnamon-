document.addEventListener("DOMContentLoaded", function () {
  
  document.querySelectorAll(".btn-eliminar-protegido").forEach(function (boton) {
    boton.addEventListener("click", function (evento) {
      var nombre = boton.getAttribute("data-nombre") || "este usuario";
      var respuesta = prompt("¡ATENCIÓN DE SEGURIDAD!\n\nPara confirmar la eliminación de " + nombre + ", escribe exactamente la palabra: ELIMINAR");
      
      if (respuesta !== "ELIMINAR") {
        alert("Acción cancelada. La palabra clave no coincidió.");
        evento.preventDefault();
      }
    });
  });

  document.querySelectorAll(".btn-eliminar:not(.btn-eliminar-protegido)").forEach(function (boton) {
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

  function pintarSelectEstado(select) {
    select.classList.remove(
      "estado-select-recibido",
      "estado-select-preparando",
      "estado-select-listo",
      "estado-select-entregado"
    );
    select.classList.add("estado-select-" + select.value);
  }

  document.querySelectorAll(".admin-tabla select[name='estado']").forEach(function (select) {
    pintarSelectEstado(select);
    select.addEventListener("change", function () {
      pintarSelectEstado(select);
    });
  });

  document.querySelectorAll("#tabla-productos .form-actualizar-producto-todo").forEach(function (form) {
    form.addEventListener("submit", function (evento) {
      var fila = form.closest("tr");
      var nombreActual = fila.querySelector(".prod-nombre").textContent.trim();
      var catActual = fila.querySelector(".prod-categoria").textContent.trim();
      var precioActual = parseFloat(fila.querySelector(".prod-precio").textContent);
      var dispoActual = fila.querySelector(".prod-estado").getAttribute("data-dispo");

      var nuevoNombre = prompt("1/4. Nombre del producto:", nombreActual);
      if (nuevoNombre === null || nuevoNombre.trim() === "") { evento.preventDefault(); return; }

      var nuevaCat = prompt("2/4. Categoría (Comida, Bebidas, Postres):", catActual);
      if (nuevaCat === null || nuevaCat.trim() === "") { evento.preventDefault(); return; }

      var nuevoPrecio = prompt("3/4. Precio ($):", precioActual);
      if (nuevoPrecio === null || isNaN(parseFloat(nuevoPrecio)) || parseFloat(nuevoPrecio) <= 0) { evento.preventDefault(); return; }

      var nuevaDispo = prompt("4/4. Disponibilidad (1 = Disponible, 0 = Agotado):", dispoActual);
      if (nuevaDispo === null || (nuevaDispo !== "0" && nuevaDispo !== "1")) { evento.preventDefault(); return; }

      form.querySelector(".input-edit-nombre").value = nuevoNombre.trim();
      form.querySelector(".input-edit-categoria").value = nuevaCat.trim();
      form.querySelector(".input-edit-precio").value = parseFloat(nuevoPrecio);
      form.querySelector(".input-edit-dispo").value = parseInt(nuevaDispo);
    });
  });

  document.querySelectorAll("#tabla-insumos .form-actualizar-modal").forEach(function (form) {
    form.addEventListener("submit", function (evento) {
      var fila = form.closest("tr");
      var nombreInsumo = fila.cells[0].textContent.trim();
      var spanCantidad = fila.querySelector(".cantidad-val");
      var cantidadActual = parseFloat(spanCantidad.textContent);

      var nuevaCantidad = prompt("Introduce la nueva cantidad disponible para " + nombreInsumo + ":", cantidadActual);

      if (nuevaCantidad !== null && !isNaN(parseFloat(nuevaCantidad)) && parseFloat(nuevaCantidad) >= 0) {
        form.querySelector(".input-hidden-cantidad").value = parseFloat(nuevaCantidad);
      } else {
        evento.preventDefault();
      }
    });
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

  document.querySelectorAll(".admin-main form:not(.form-actualizar-producto-todo):not(.form-actualizar-modal)").forEach(function (formulario) {
    formulario.addEventListener("submit", function (evento) {
      var inputPrecio = formulario.querySelector("input[type='number']");
      if (inputPrecio && parseFloat(inputPrecio.value) <= 0) {
        alert("Por favor, introduce un valor mayor a cero.");
        evento.preventDefault();
      }
    });
  });

});