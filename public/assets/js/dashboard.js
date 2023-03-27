Chart.defaults.font.size = 18;
Chart.defaults.font.family = 'Roboto, sans-serif';
Chart.defaults.font.weight = 'bold';
Chart.defaults.font.color = '#000000';


// assets/js/history.js

const currentDate = new Date();
const currentYear = currentDate.getFullYear();
const currentMonth = currentDate.getMonth();

const generateLast12Months = () => {
    const last12Months = [];
    for (let i = 11; i >= 0; i--) {
        const newDate = new Date(currentYear, currentMonth - i);
        last12Months.push(newDate);
    }
    return last12Months;
};

function monthName(dateString) {
    const date = new Date(dateString);
    const monthNames = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    return monthNames[date.getMonth()];
}


const last12Months = generateLast12Months();

const responsesDataElement = document.getElementById("responses-data");
const responsesCountByMonth = JSON.parse(responsesDataElement.getAttribute("data-responses-count-by-month"));

const responsesCountArray = Object.entries(responsesCountByMonth).map(([month, count]) => ({ month, count }));

const createCompleteData = (monthsArray, dataArray) => {
    const completeData = monthsArray.map(month => {
        const dateKey = `${month.getFullYear()}-${String(month.getMonth() + 1).padStart(2, '0')}`;
        const existingData = dataArray.find(data => data.month === dateKey);
        return existingData ? existingData.count : 0;
    });
    return completeData;
};

const labels = last12Months.map(date => date.toLocaleString('fr-FR', { month: 'long', year: 'numeric' }));
const dataPoints = createCompleteData(last12Months, responsesCountArray);

const dataPoll = {
    labels: labels,
    datasets: [
        {
            data: dataPoints,
            borderColor: '#4dc9f6',
            fill: false,
            cubicInterpolationMode: 'monotone',
            tension: 0.4
        }
    ]
};

const config_HistoryChart = {
    type: 'line',
    data: dataPoll,
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
                    display: true,
                }
            },
            y: {
                display: true,
                title: {
                    display: true,
                    text: 'Nombre de réponses'
                }
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
new Chart(document.getElementById('poll_answer'), config_HistoryChart);

const clientsDataElement = document.getElementById("clients-data");
const consumersCountByMonth = JSON.parse(clientsDataElement.getAttribute("data-consumers-count-by-month"));
const consumersCountArray = Object.entries(consumersCountByMonth).map(([month, count]) => ({ month, count }));

const clientsLabels = generateLast12Months();
const clientsDataPoints = createCompleteData(last12Months, consumersCountArray);

const clientsData = {
    labels: clientsLabels,
    datasets: [
        {
            data: clientsDataPoints,
            borderColor: '#4dc9f6',
            fill: false,
            cubicInterpolationMode: 'monotone',
            tension: 0.4
        }
    ]
};


const config_clientsChart = {
    type: 'bar',
    data: clientsData,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: {
                display: false
            },
            y: {
                display: false
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    title: (context) => {
                        const index = context[0].dataIndex;
                        const label = context[0].chart.data.labels[index];
                        return monthName(label);
                    },
                },
            },
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