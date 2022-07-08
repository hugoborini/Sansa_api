const labels = [
    'Janvier',
    'Février',
    'Mars',
    'Avril',
    'Mai',
    'Juin',
    'Juillet',
    'Août',
    'Septembre'
];

const data = {
    labels: labels,
    datasets: [
        {
            label: 'Mobile',
            backgroundColor: '#FFF2B3',
            borderColor: '#FFD200',
            borderWidth: 2,
            borderRadius: 24,
            data: [5, 58, 53, 72, 27, 37, 75, 12,36],
        },
        {
            label: 'Borne',
            backgroundColor: '#CCD7E1',
            borderColor: '#55789B',
            borderWidth: 2,
            borderRadius: 8,
            data: [73, 9, 41, 29, 3, 8, 28, 43, 62],
        }
    ]
};

const config = {
    type: 'bar',
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
                align: 'end'
            }
        }
    },
};

const myChart = new Chart(
    document.getElementById('myChart'),
    config
);