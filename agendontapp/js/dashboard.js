// Datos ejemplo
const citasData = {
    labels: ['2024-11-01', '2024-11-02', '2024-11-03', '2024-11-04', '2024-11-05'],
    datasets: [{
        label: 'Citas por Día',
        data: [10, 15, 7, 20, 14], // Reemplaza con datos reales
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
    }]
};

const pacientesData = {
    labels: ['Niños', 'Adultos', 'Mayores'],
    datasets: [{
        label: 'Pacientes por Edad',
        data: [10, 50, 20], // Reemplaza con datos reales
        backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56'],
    }]
};

// Gráfico de Citas
const citasChart = new Chart(document.getElementById('citasChart'), {
    type: 'line',
    data: citasData,
    options: {
        responsive: true,
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Fecha'
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Total de Citas'
                }
            }
        }
    }
});

// Gráfico de Pacientes
const pacientesChart = new Chart(document.getElementById('pacientesChart'), {
    type: 'pie',
    data: pacientesData,
    options: {
        responsive: true
    }
});

// Filtro de Fecha
document.querySelector('.filter-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const fechaInicio = document.getElementById('fecha_inicio').value;
    const fechaFin = document.getElementById('fecha_fin').value;
    
    // Aquí puedes realizar una consulta AJAX para obtener los datos filtrados
    console.log('Filtrar desde:', fechaInicio, 'hasta:', fechaFin);
    
    // Ejemplo de cómo actualizar un gráfico
    citasChart.data.datasets[0].data = [12, 8, 10, 15, 9]; // Nuevos datos filtrados
    citasChart.update();
});

// Mostrar alertas (Ejemplo)
function showAlert(message) {
    const alertsDiv = document.getElementById('alerts');
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert';
    alertDiv.textContent = message;
    alertsDiv.appendChild(alertDiv);
}

// Llamar a la alerta
showAlert("¡Recuerda que tienes citas pendientes!");
