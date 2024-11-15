// mensagem de alerta automática

document.addEventListener("DOMContentLoaded", function () {
    const alerts = document.querySelectorAll(".alert");
    if (alerts.length > 0) {
        setTimeout(() => {
            alerts.forEach(alert => alert.remove());
        }, 5000); // Remove alertas após 5 segundos
    }
});

