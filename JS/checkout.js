function mostrarInstrucciones() {
    const metodo = document.getElementById('metodo').value;
    const contenedorInfo = document.getElementById('instrucciones');
    if (metodo === "") {
        contenedorInfo.style.display = "none";
        contenedorInfo.innerHTML = "";
        return;
    }

    contenedorInfo.style.display = "block";
    let contenido = "";

    switch (metodo) {
        case 'tarjeta':
            contenido = `
                <div class="checkout-bloque dinamico-pago">
                    <h3>Datos de la tarjeta</h3>
                    <div class="form-grupo-pago">
                        <label for="num-tarjeta">Número de tarjeta</label>
                        <input type="text" id="num-tarjeta" placeholder="1234 5678 1234 5678" maxlength="19" required>
                    </div>
                    <div class="form-grupo-pago-corto">
                        <div>
                            <label for="fecha-exp">Expiración</label>
                            <input type="text" id="fecha-exp" placeholder="MM/AA" maxlength="5" required>
                        </div>
                        <div>
                            <label for="cvv">CVV</label>
                            <input type="password" id="cvv" placeholder="123" maxlength="3" required>
                        </div>
                    </div>
                </div>
            `;
            break;

        case 'transferencia':
            contenido = `
                <div class="checkout-bloque dinamico-pago">
                    <h3>Datos de Transferencia</h3>
                    <p style="margin-bottom: 15px;">Deposita a la CLABE: <strong>0123 4567 8901 2345</strong></p>
                    <div class="form-grupo-pago">
                        <label for="comprobante">Sube tu comprobante de pago</label>
                        <input type="file" id="comprobante" accept="image/*,.pdf" required>
                    </div>
                </div>
            `;
            break;

        case 'efectivo':
            contenido = `
                <div class="checkout-bloque dinamico-pago">
                    <h3>Pago en Efectivo</h3>
                    <p style="margin-bottom: 15px;">Se generará un código de barras. Tienes 48 horas para pagar en caja.</p>
                    <div class="form-grupo-pago">
                        <label for="correo-ticket">Enviar código de barras al correo:</label>
                        <input type="email" id="correo-ticket" placeholder="tu-correo@ejemplo.com" required>
                    </div>
                </div>
            `;
            break;

        default:
            contenido = "<p>Opción no válida.</p>";
    }

    contenedorInfo.innerHTML = contenido;
}