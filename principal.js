document.addEventListener("DOMContentLoaded", function () {
    var lista = document.getElementById("lista-ingredientes");
    if (!lista) return;
    var items = lista.querySelectorAll(".ingrediente-item");
    var puntosContenedor = document.getElementById("carousel-dots");
    var btnPrev = document.getElementById("carousel-prev");
    var btnNext = document.getElementById("carousel-next");
    var mensaje = document.getElementById("mensaje-busqueda");
    var indiceActual = 0;
    var intervaloAuto = null;

    items.forEach(function (item, indice) {
        var punto = document.createElement("button");
        punto.className = "carousel-dot";
        punto.setAttribute("aria-label", "Ir al ingrediente " + (indice + 1));
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
        }, 5000);
    }

    btnPrev.addEventListener("click", function () {
        irASlide(indiceActual - 1);
        reiniciarAutoAvance();
    });

    btnNext.addEventListener("click", function () {
        irASlide(indiceActual + 1);
        reiniciarAutoAvance();
    });

    var carrusel = document.querySelector(".carousel-ingredientes");
    carrusel.addEventListener("mouseenter", function () {
        clearInterval(intervaloAuto);
    });
    carrusel.addEventListener("mouseleave", reiniciarAutoAvance);

    irASlide(0);
    reiniciarAutoAvance();

    var inputBuscar = document.getElementById("buscador-ingrediente");
    var btnBuscar = document.getElementById("btn-buscar-ingrediente");

    function buscarIngrediente() {
        var termino = inputBuscar.value.trim().toLowerCase();
        if (!termino) {
            mensaje.textContent = "";
            return;
        }

        var encontrado = -1;
        items.forEach(function (item, indice) {
            var nombre = item.querySelector("h3").textContent.toLowerCase();
            if (encontrado === -1 && nombre.includes(termino)) {
                encontrado = indice;
            }
        });

        if (encontrado !== -1) {
            irASlide(encontrado);
            reiniciarAutoAvance();
            mensaje.textContent = "Mostrando: " + items[encontrado].querySelector("h3").textContent;
        } else {
            mensaje.textContent = "No encontramos ese ingrediente en nuestros destacados.";
        }
    }

    btnBuscar.addEventListener("click", buscarIngrediente);
    inputBuscar.addEventListener("keydown", function (evento) {
        if (evento.key === "Enter") {
            evento.preventDefault();
            buscarIngrediente();
        }
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