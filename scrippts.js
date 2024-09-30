// Gráfico de Donaciones Recibidas por Mes
const donationsChart = new Chart(document.getElementById('donationsChart'), {
    type: 'bar',
    data: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio'],
        datasets: [{
            label: 'Donaciones Recibidas ($)',
            data: [500, 700, 800, 650, 900, 1200, 1100],
            backgroundColor: '#2980b9'
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Gráfico de Distribución de Gastos
const expensesChart = new Chart(document.getElementById('expensesChart'), {
    type: 'pie',
    data: {
        labels: ['Atención Veterinaria', 'Refugios', 'Alimentos', 'Programas de Adopción'],
        datasets: [{
            data: [40, 30, 20, 10],
            backgroundColor: ['#3498db', '#e74c3c', '#f1c40f', '#2ecc71']
        }]
    }
});

// Gráfico de Evolución de Animales Rescatados
const rescuedAnimalsChart = new Chart(document.getElementById('rescuedAnimalsChart'), {
    type: 'line',
    data: {
        labels: ['2018', '2019', '2020', '2021', '2022'],
        datasets: [{
            label: 'Animales Rescatados',
            data: [100, 150, 200, 250, 300],
            borderColor: '#e67e22',
            fill: false
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Gráfico de Impacto en Diferentes Áreas
const impactChart = new Chart(document.getElementById('impactChart'), {
    type: 'doughnut',
    data: {
        labels: ['Rescate', 'Rehabilitación', 'Adopción', 'Concienciación'],
        datasets: [{
            data: [35, 25, 25, 15],
            backgroundColor: ['#9b59b6', '#1abc9c', '#f39c12', '#e74c3c']
        }]
    }
});
