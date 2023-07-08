// API Call from the backend to get the data for the charts
// getting milk records
let dataOfMilkProduction = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
let dataOfBreedDistribution = [[], []];

const milkAPIsettings = {
  contentType: false,
  processData: false,
  type: "POST",
  url: "./GetAllMilkRecordsByMonth?id=-99",
  success: function (response) {
    console.log(response)
    console.log(JSON.parse(response));
    let data = JSON.parse(response);

    console.log(dataOfMilkProduction);
    //Iterating through the response and adding the milk production to the array
    for (let i = 0; i < JSON.parse(response).length; i++) {
      {
        let month = parseInt(data[i]["month"], 10);

        console.log(month, "month");

        dataOfMilkProduction[month - 1] = parseInt(
          data[i]["total_milk_production"],
          10
        );
      }
    }
    //Printing the chart
    printMilkChart();
  },
  error: function (err, type, httpStatus) {
    console.log(err, type, httpStatus);
  },
};

//breed distribution settings
const breedAPIsettings = {
  contentType: false,
  processData: false,
  type: "POST",
  url: "./GetCowBreedsApi",
  success: function (response) {
    let data = JSON.parse(response);
    for (let i = 0; i < data.length; i++) {
      dataOfBreedDistribution[0].push(data[i].breed);
      dataOfBreedDistribution[1].push(data[i].breed_count);
    }

    // console.log(dataOfBreedDistribution);
    printBreedChart();
  },
  error: function (err, type, httpStatus) {
    console.log(err, type, httpStatus);
  },
};

//API call for the Milk records
$.ajax(milkAPIsettings);
//API call for the Breed Distribution
$.ajax(breedAPIsettings);

//Function to print the Milk production chart
function printMilkChart() {
  const ctx1 = document.getElementById("myChart1").getContext("2d");

  const months = [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "May",
    "Jun",
    "Jul",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec",
  ];

  new Chart(ctx1, {
    type: "line",
    data: {
      labels: months,
      datasets: [
        {
          label: "Milk Production (liters)",
          data: dataOfMilkProduction,
          backgroundColor: "rgba(54, 162, 235, 0.5)",
          borderColor: "rgb(54, 162, 235)",
          borderWidth: 1,
          pointRadius: 3,
          pointBackgroundColor: "rgb(54, 162, 235)",
          pointBorderColor: "rgb(54, 162, 235)",
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
}
function printBreedChart() {
  const ctx3 = document.getElementById("myChart3").getContext("2d");

  const breedLabels = [
    "Holstein",
    "Angus",
    "Jersey",
    "Hereford",
    "Simmental",
    "Limousin",
    "Charolais",
  ];

  new Chart(ctx3, {
    type: "bar",
    data: {
      labels: dataOfBreedDistribution[0],
      datasets: [
        {
          label: "Cattle Breed Distribution",
          data: dataOfBreedDistribution[1],
          backgroundColor: "rgba(255, 99, 132, 0.5)",
          borderColor: "rgb(255, 99, 132)",
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
}

//Dont touch this line of code i have no idea what it does but it does somethings
window.jsPDF = window.jspdf.jsPDF;
//----------------------------------------------
const ctx = document.getElementById("myChart").getContext("2d");

new Chart(ctx, {
  type: "bar",
  data: {
    labels: ["Dead", "Healthy", "Diseased", "Pregnant"],
    datasets: [
      {
        label: "# of Cows",
        data: [
          getRandomValue(),
          getRandomValue(),
          getRandomValue(),
          getRandomValue(),
        ],
        backgroundColor: [
          "rgba(255, 99, 132, 0.5)",
          "rgba(54, 162, 235, 0.5)",
          "rgba(255, 205, 86, 0.5)",
          "rgba(75, 192, 192, 0.5)",
        ],
        borderColor: [
          "rgb(255, 99, 132)",
          "rgb(54, 162, 235)",
          "rgb(255, 205, 86)",
          "rgb(75, 192, 192)",
        ],
        borderWidth: 1,
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

const ctx2 = document.getElementById("myChart2").getContext("2d");

const feedTypes = ["Grass", "Hay", "Silage", "Concentrate", "Minerals"];

new Chart(ctx2, {
  type: "bar",
  data: {
    labels: feedTypes,
    datasets: [
      {
        label: "Quantity of Feed (kg)",
        data: generateRandomDataForFeed(),
        backgroundColor: "rgba(75, 192, 192, 0.5)",
        borderColor: "rgb(75, 192, 192)",
        borderWidth: 1,
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

function generateRandomDataForBreed() {
  const data = [];
  const totalCows = 1000; // Total number of cows in the herd
  for (let i = 0; i < breedLabels.length; i++) {
    const breedPercentage = Math.random(); // Random breed percentage between 0 and 1
    const breedCount = Math.round(breedPercentage * totalCows);
    data.push(breedCount);
  }
  return data;
}

function generateRandomDataForFeed() {
  const data = [];
  for (let i = 0; i < feedTypes.length; i++) {
    const quantity = Math.floor(Math.random() * 100 + 50); // Random value between 50 and 150 kg
    data.push(quantity);
  }
  return data;
}

function generateRandomDataForMilk() {
  const data = [];
  for (let i = 0; i < 12; i++) {
    const production = Math.floor(Math.random() * 2000 + 1000); // Random value between 1000 and 3000 liters
    data.push(production);
  }
  return data;
}

//Print Functionality over here
function getRandomValue() {
  return Math.floor(Math.random() * 50) + 1; // Random value between 1 and 50
}

$(".PrintBtn").click(function () {
  printChart(this.id);
});
const printChart = (a) => {
  const doc = new jsPDF();
  if (a == "0") {
    doc.addImage(ctx.canvas.toDataURL(), "JPEG", 10, 10, 190, 100);
  } else if (a == "1") {
    doc.addImage(ctx1.canvas.toDataURL(), "JPEG", 10, 10, 190, 100);
  } else if (a == "2") {
    doc.addImage(ctx2.canvas.toDataURL(), "JPEG", 10, 10, 190, 100);
  } else if (a == "3") {
    doc.addImage(ctx3.canvas.toDataURL(), "JPEG", 10, 10, 190, 100);
  }

  doc.save("chart.pdf"); // Save the PDF
};
