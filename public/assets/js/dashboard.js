Chart.defaults.font.size = 18;
Chart.defaults.font.family = 'Roboto, sans-serif';
Chart.defaults.font.weight = 'bold';
Chart.defaults.font.color = '#000000';


const DATA_COUNT = 12;
const datapoints = [0, 20, 20, 60, 60, 120, 180, 120, 125, 105, 110];
const months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
const labels = months.slice(0, DATA_COUNT);
const data = {
    labels: labels,
    datasets: [
        {
            data: datapoints,
            borderColor: '#4dc9f6',
            fill: false,
            cubicInterpolationMode: 'monotone',
            tension: 0.4
        }
    ]
};

const config_PollAnswers = {
    type: 'line',
    data: data,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: {
            intersect: false,
        },
        scales: {
            x: {
                display: true,
                title: {
                    display: true
                }
            },
            y: {
                display: false,
                title: {
                    display: true,
                    text: 'Value'
                },
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    },
};


new Chart(document.getElementById('poll_answer'), config_PollAnswers);

const config_clientsChart = {
    type: 'bar',
    data: data,
    options: {
        responsive: true,
        scales: {
            x: {
                display: false
            },
            y: {
                display: false
            }
        },
        plugins: {
            legend: {
                position: 'top',
                display: false
            },
            title: {
                display: false,
                text: 'Chart.js Floating Bar Chart'
            }
        }
    }
};

new Chart(document.getElementById('clientsChart'), config_clientsChart);


function responsiveFonts() {
    const html = document.querySelector('html');
    const width = html.clientWidth;
    html.style.fontSize = width / 19.2 + 'px';
}