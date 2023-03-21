Chart.defaults.font.size = 18;
Chart.defaults.font.family = "Roboto, sans-serif";
Chart.defaults.font.weight = "bold";
Chart.defaults.font.color = "#000000";

const months = [
  "Janvier",
  "Février",
  "Mars",
  "Avril",
  "Mai",
  "Juin",
  "Juillet",
  "Août",
  "Septembre",
  "Octobre",
  "Novembre",
  "Décembre",
];
const labels = months;
const data = {
  labels: labels,
  datasets: [
    {
      data: [1, 2, 1, 4, 6, 2, 1, 3, 1, 4, 2, 2],
      borderColor: "#4dc9f6",
      fill: false,
      cubicInterpolationMode: "",
      tension: 0.4,
      borderColor: "#000",
      borderWidth: 1,
      grouped: true

    },
  ],
};

const config = {
  type: "bar",
  data: data,
  grouped: true,
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
};

const config_clientsChart = {
  type: "bar",
  data: data,
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      x: {
        display: false,
      },
      y: {
        display: false,
      },
      
    },
    plugins: {
      legend: {
        position: "top",
        display: false,
      },
      title: {
        display: false,
        text: "Chart.js Floating Bar Chart",
      },
    },
  },
};

new Chart(document.getElementById("bar"), config_clientsChart);

function responsiveFonts() {
  const html = document.querySelector("html");
  const width = html.clientWidth;
  html.style.fontSize = width / 19.2 + "px";
}
