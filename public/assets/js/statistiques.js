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
      fill: false,
      cubicInterpolationMode: "monotone",
      tension: 0.4,
      borderColor: "#000",
      borderWidth: 2,
      backgroundColor: "#dedede"

    },
  ],
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
        display: true,
        text: "Nombre de mauvais retour sur le produit \"Huile de ricin\"",
      },
    },
  },
};

const dataa = {
    labels: ["Satisfaite", "Insatisfaite"],
    datasets: [
      {
        data: [75, 25],
        borderColor: "#000",
        fill: false,
        cubicInterpolationMode: "monopole",
        tension: 0.4,
        borderWidth: 1,
        grouped: true,
        backgroundColor: [
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 99, 132, 0.6)',
        ]
      },
    ],
  };

const config_pieChart = {
    type: 'pie',
    data: dataa,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'right',
        },
        title: {
          display: true,
          text: 'Indice de satisfaction sur le produit \"Huile de ricin\"'
        }
      }
    },
  };

new Chart(document.getElementById("bar"), config_clientsChart);
new Chart(document.getElementById("pie"), config_pieChart);



function responsiveFonts() {
  const html = document.querySelector("html");
  const width = html.clientWidth;
  html.style.fontSize = width / 19.2 + "px";
}
