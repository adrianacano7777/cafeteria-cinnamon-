document.addEventListener("DOMContentLoaded", function () {
  var pagina = window.location.pathname.split("/").pop();

  var headerCliente = `
    <header>
      <div class="logo">
        <a href="principal.html">
          <img src="img/logo.png" alt="Logo Cafetería">
        </a>
      </div>
      <nav class="main-nav">
        <ul class="nav-list">
          <li><a href="principal.html" data-pagina="principal.html">Inicio</a></li>
          <li><a href="menu_comida.html" data-pagina="menu_comida.html">Comida</a></li>
          <li><a href="menu_postres.html" data-pagina="menu_postres.html">Postres</a></li>
          <li><a href="menu_bebidas.html" data-pagina="menu_bebidas.html">Bebidas</a></li>
          <li><a href="carrito.html" data-pagina="carrito.html">Carrito</a></li>
          <li><a href="historial.html" data-pagina="historial.html">Historial</a></li>
          <li><a href="perfil.html" data-pagina="perfil.html">Mi perfil</a></li>
          <li><a href="login.html" data-pagina="login.html">Iniciar sesión</a></li>
        </ul>
      </nav>
    </header>
  `;

  var headerAdmin = `
    <header>
      <div class="logo">
        <span class="admin-titulo">Cinnamon · Administrador</span>
      </div>
      <nav class="main-nav">
        <ul class="nav-list">
          <li><a href="admin_inventario.html" data-pagina="admin_inventario.html">Inventario</a></li>
          <li><a href="admin_pedidos.html" data-pagina="admin_pedidos.html">Pedidos</a></li>
          <li><a href="admin_usuarios.html" data-pagina="admin_usuarios.html">Usuarios</a></li>
          <li><a href="principal.html" data-pagina="salir">Salir</a></li>
        </ul>
      </nav>
    </header>
  `;

  var footerHTML = `
    <footer>
      <h4>Contáctanos</h4>
      <p>cinnamoncafe2026@gmail.com</p>
      <p>&copy;2026 Cafetería Cinnamon. Creada en 2026</p>
    </footer>
  `;

  var headerPlaceholder = document.getElementById("header-placeholder");
  var footerPlaceholder = document.getElementById("footer-placeholder");

  if (headerPlaceholder) {
    var tipo = headerPlaceholder.getAttribute("data-tipo");
    headerPlaceholder.innerHTML = tipo === "admin" ? headerAdmin : headerCliente;
  }
  if (footerPlaceholder) {
    footerPlaceholder.innerHTML = footerHTML;
  }

  document.querySelectorAll("nav a[data-pagina]").forEach(function (enlace) {
    if (enlace.getAttribute("data-pagina") === pagina) {
      enlace.classList.add("nav-activo");
    }
  });
});