document.addEventListener("DOMContentLoaded", function () {
  var pagina = window.location.pathname.split("/").pop();

  var headerCliente = `
    <header>
      <div class="logo">
        <a href="index.php">
          <img src="../img/logo.png" alt="Logo Cafetería">
        </a>
      </div>
      <nav class="main-nav">
        <ul class="nav-list">
          <li><a href="../php/index.php" data-pagina="index.php">Inicio</a></li>
          <li><a href="../php/menu_comida.php" data-pagina="menu_comida.php">Comida</a></li>
          <li><a href="../php/menu_postres.php" data-pagina="menu_postres.php">Postres</a></li>
          <li><a href="../php/menu_bebidas.php" data-pagina="menu_bebidas.php">Bebidas</a></li>
          <li><a href="../php/carrito.php" data-pagina="carrito.php">Carrito</a></li>
          <li><a href="historial.php" data-pagina="historial.php">Historial</a></li>
          <li><a href="perfil.php" data-pagina="perfil.php">Mi perfil</a></li>
          <li><a href="login.php" data-pagina="login.php">Iniciar sesión</a></li>
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
          <li><a href="admin_inventario.php" data-pagina="admin_inventario.php">Inventario</a></li>
          <li><a href="admin_pedidos.php" data-pagina="admin_pedidos.php">Pedidos</a></li>
          <li><a href="admin_usuarios.php" data-pagina="admin_usuarios.php">Usuarios</a></li>
          <li><a href="index.php" data-pagina="salir">Salir</a></li>
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