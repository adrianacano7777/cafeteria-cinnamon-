document.addEventListener("DOMContentLoaded", function () {
  function crearCarrusel(config) {
    var lista = document.getElementById(config.idLista);
    if (!lista) return;
    var items = lista.querySelectorAll(config.selectorItem);
    var puntosContenedor = document.getElementById(config.idPuntos);
    var btnPrev = config.idPrev ? document.getElementById(config.idPrev) : null;
    var btnNext = config.idNext ? document.getElementById(config.idNext) : null;
    var indiceActual = 0;
    var intervaloAuto = null;
    items.forEach(function (item, indice) {
      var punto = document.createElement("button");
      punto.className = "carousel-dot";
      punto.setAttribute("aria-label", "Ir al elemento " + (indice + 1));
      punto.addEventListener("click", function () {
        irASlide(indice);
        reiniciarAutoAvance();
      });
      puntosContenedor.appendChild(punto);
    });
    var puntos = puntosContenedor.querySelectorAll(".carousel-dot");
    function irASlide(indice) {
      indiceActual = (indice + items.length) % items.length;
      lista.style.transform = "translateX(-" + (indiceActual * 100) + "%)";
      puntos.forEach(function (punto, i) {
        punto.classList.toggle("activo", i === indiceActual);
      });
    }
    function reiniciarAutoAvance() {
      clearInterval(intervaloAuto);
      intervaloAuto = setInterval(function () {
        irASlide(indiceActual + 1);
      }, config.intervalo || 5000);
    }
    if (btnPrev) {
      btnPrev.addEventListener("click", function () {
        irASlide(indiceActual - 1);
        reiniciarAutoAvance();
      });
    }
    if (btnNext) {
      btnNext.addEventListener("click", function () {
        irASlide(indiceActual + 1);
        reiniciarAutoAvance();
      });
    }
    var contenedor = lista.closest(config.selectorContenedor);
    if (contenedor) {
      contenedor.addEventListener("mouseenter", function () {
        clearInterval(intervaloAuto);
      });
      contenedor.addEventListener("mouseleave", reiniciarAutoAvance);
    }
    irASlide(0);
    reiniciarAutoAvance();
  }
  crearCarrusel({
    idLista: "lista-ingredientes",
    selectorItem: ".ingrediente-item",
    idPuntos: "carousel-dots",
    idPrev: "carousel-prev",
    idNext: "carousel-next",
    selectorContenedor: ".carousel-ingredientes",
    intervalo: 5000
  });
  crearCarrusel({
    idLista: "lista-resenas",
    selectorItem: ".reseña-carta",
    idPuntos: "carousel-dots-resenas",
    selectorContenedor: ".carousel-resenas",
    intervalo: 4500
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