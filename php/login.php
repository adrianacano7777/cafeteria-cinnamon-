<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cafetería Cinnamon - Iniciar sesión</title>
  <link rel="icon" href="../img/icono-pestana.png" type="image/png">
  <link rel="stylesheet" href="../css/login.css">
</head>

<body>
  <div id="header-placeholder"></div>
  <section class="acceso">
    <h2 class="seccion-titulo">Entrar a mi cuenta</h2>
    <p class="acceso-intro">
      Si ya tienes una cuenta con nosotros, inicia sesión en el primer recuadro.
      Si es tu primera vez en Cafetería Cinnamon, llena el segundo recuadro para crear tu cuenta.
      Los campos marcados con <span class="campo-obligatorio">*</span> son obligatorios; los demás los puedes dejar en
      blanco y llenarlos después.
    </p>

    <div class="acceso-contenedor-paneles">
      <div class="acceso-panel" id="iniciar-sesion">
        <h3>Ya tengo cuenta: Iniciar sesión</h3>
        <form class="form-acceso" action="perfil.php" method="post">
          <label for="login-correo">Correo electrónico <span class="campo-obligatorio">*</span></label>
          <input type="email" id="login-correo" name="correo" placeholder="Ejemplo: nombre@gmail.com" required>
          <p class="texto-ayuda">Escribe el correo con el que te registraste.</p>
          <label for="login-contrasena">Contraseña <span class="campo-obligatorio">*</span></label>
          <input type="password" id="login-contrasena" name="contrasena" placeholder="Escribe tu contraseña" required>
          <button type="submit" class="btn-primario">Entrar</button>
        </form>
      </div>


      <div class="acceso-panel" id="crear-cuenta">
        <h3>Crear cuenta</h3>
        <form class="form-acceso" action="perfil.php" method="post">
          <label for="registro-nombre">Nombre completo <span class="campo-obligatorio">*</span></label>
          <input type="text" id="registro-nombre" name="nombre" placeholder="Ejemplo: María López" required>

          <label for="registro-correo">Correo electrónico <span class="campo-obligatorio">*</span></label>
          <input type="email" id="registro-correo" name="correo" placeholder="Ejemplo: nombre@gmail.com" required>
          <p class="texto-ayuda">Usaremos este correo para avisarte sobre tus pedidos.</p>

          <label for="registro-contrasena">Crea una contraseña <span class="campo-obligatorio">*</span></label>
          <input type="password" id="registro-contrasena" name="contrasena" placeholder="Mínimo 6 caracteres" required>

          <label for="registro-direccion">Tu dirección (opcional, la puedes agregar después)</label>
          <input type="text" id="registro-direccion" name="calle_numero" placeholder="Calle, número y colonia">
          <p class="texto-ayuda">Solo es necesaria si vas a pedir a domicilio. Puedes omitir este paso ahora.</p>

          <label for="registro-telefono">Teléfono de contacto</label>
          <input type="tel" id="registro-telefono" name="telefono_contacto" placeholder="Ejemplo: 7341234567">

          <button type="submit" class="btn-primario">Crear mi cuenta</button>
        </form>
      </div>

    </div>
  </section>

  <div id="footer-placeholder"></div>
  <script src="../JS/header-footer.js"></script>

  <script>
    const formularioLogin = document.querySelector("#iniciar-sesion form");
    const botonEnviar = formularioLogin.querySelector("button[type='submit']");

    botonEnviar.addEventListener("click", function(evento) {
        formularioLogin.setAttribute("novalidate", "true");
    });

    formularioLogin.addEventListener("submit", function(evento) {
        const elementos = formularioLogin.elements;
        let formularioValido = true;

        for (let i = 0; i < elementos.length; i++) {
            if (elementos[i].hasAttribute("required") && elementos[i].value.trim() === "") {
                formularioValido = false;
                break;
            }
        }

        if (!formularioValido) {
            evento.preventDefault();
            alert("¡Error! Por favor escribe tu correo electrónico.");
            formularioLogin.removeAttribute("novalidate");
        }
    });
  </script>

</body>

</html> 