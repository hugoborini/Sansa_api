const labels = [
    'Janvier',
    'Février',
    'Mars',
    'Avril',
    'Mai',
    'Juin',
    'Juillet'
];

const data = {
    labels: labels,
    datasets: [
        {
            borderColor: '#FFD200',
            borderWidth: 2,
            borderRadius: 24,
            data: [5, 58, 53, 72, 27, 37, 75, 12,36],
        }
    ]
};

const config = {
    type: 'line',
    data: data,
    options: {
        scales: {
            y: { // defining min and max so hiding the dataset does not change scale range
                min: 0,
                max: 80
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    },
};

const myChart = new Chart(
    document.getElementById('myChart'),
    config
);