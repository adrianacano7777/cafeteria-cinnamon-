function mostrarInstrucciones() {
    const metodo = document.getElementById('metodo').value;
    const contenedorInfo = document.getElementById('instrucciones');

    if (metodo === "") {
        contenedorInfo.style.display = "none";
        return;
    }
    contenedorInfo.style.display = "block";
        let mensaje = "";
        switch (metodo) {
            case 'tarjeta':
                mensaje = "<strong>Pago con tarjeta:</strong><br>Serás redirigido a una pasarela segura para ingresar tus 16 dígitos.";
                break;
            case 'transferencia':
                mensaje = "<strong>Transferencia:</strong><br>Deposita a la Clabe: 0123 4567 8901 2345 y envía tu comprobante por correo.";
                break;
            case 'efectivo':
                mensaje = "<strong>Efectivo:</strong><br>Se generará un código de barras. Tienes 48 horas para pagar en caja.";
                break;
            default:
                mensaje = "Opción no válida.";
            }

            contenedorInfo.innerHTML = mensaje;
}