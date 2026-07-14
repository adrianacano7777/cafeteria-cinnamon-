function verificarHorario() {
    const textoHorario = document.getElementById('texto-horario');
    const indicador = document.getElementById('indicador-estado');
    const ahora = new Date();
    const diaSemana = ahora.getDay();
    const horaActual = ahora.getHours();
    const horaApertura = 8;
    const horaCierre = 22;
    if (diaSemana !== 0 && horaActual >= horaApertura && horaActual < horaCierre) {
        textoHorario.textContent = "¡Estamos abiertos! Pide tu café favorito ahora.";
        indicador.className = "circulo abierto";
    } else {
        if (diaSemana === 0) {
            textoHorario.textContent = "Cerrado por hoy. Te esperamos mañana a las 8:00 AM.";
        } else {
            textoHorario.textContent = "Cerrado en este momento. Abrimos mañana a las 8:00 AM.";
        }
        indicador.className = "circulo cerrado";
    }
}
window.addEventListener('DOMContentLoaded', verificarHorario);