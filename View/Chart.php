<div class="MainPage">
  <div>
    <h1>Cow Population</h1>
    <canvas class="Chart" id="myChart"></canvas>
    <h1>Milk Production</h1>
    <canvas class="Chart" id="myChart1"></canvas>
    <h1>Feed</h1>
    <canvas class="Chart" id="myChart2"></canvas>
    <h1>Breed</h1>
    <canvas class="Chart" id="myChart3"></canvas>
    <canvas id="myChart4"></canvas>
  </div>
</div>

<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->

<script>
  const ctx = document.getElementById('myChart').getContext('2d');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Dead', 'Healthy', 'Diseased', 'Pregnant'],
      datasets: [{
        label: '# of Cows',
        data: [getRandomValue(), getRandomValue(), getRandomValue(), getRandomValue()],
        backgroundColor: ['rgba(255, 99, 132, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 205, 86, 0.5)', 'rgba(75, 192, 192, 0.5)'],
        borderColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)', 'rgb(75, 192, 192)'],
        borderWidth: 1
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


  const ctx1 = document.getElementById('myChart1').getContext('2d');

const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

new Chart(ctx1, {
  type: 'line',
  data: {
    labels: months,
    datasets: [{
      label: 'Milk Production (liters)',
      data: generateRandomDataForMilk(),
      backgroundColor: 'rgba(54, 162, 235, 0.5)',
      borderColor: 'rgb(54, 162, 235)',
      borderWidth: 1,
      pointRadius: 3,
      pointBackgroundColor: 'rgb(54, 162, 235)',
      pointBorderColor: 'rgb(54, 162, 235)'
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

const ctx2 = document.getElementById('myChart2').getContext('2d');

const feedTypes = ['Grass', 'Hay', 'Silage', 'Concentrate', 'Minerals'];

new Chart(ctx2, {
  type: 'bar',
  data: {
    labels: feedTypes,
    datasets: [{
      label: 'Quantity of Feed (kg)',
      data: generateRandomDataForFeed(),
      backgroundColor: 'rgba(75, 192, 192, 0.5)',
      borderColor: 'rgb(75, 192, 192)',
      borderWidth: 1
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

const ctx3 = document.getElementById('myChart3').getContext('2d');

const breedLabels = ['Holstein', 'Angus', 'Jersey', 'Hereford', 'Simmental', 'Limousin', 'Charolais'];

new Chart(ctx3, {
  type: 'bar',
  data: {
    labels: breedLabels,
    datasets: [{
      label: 'Cattle Breed Distribution',
      data: generateRandomDataForBreed(),
      backgroundColor: 'rgba(255, 99, 132, 0.5)',
      borderColor: 'rgb(255, 99, 132)',
      borderWidth: 1
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
    const quantity = Math.floor((Math.random() * 100) + 50); // Random value between 50 and 150 kg
    data.push(quantity);
  }
  return data;
}

function generateRandomDataForMilk() {
  const data = [];
  for (let i = 0; i < 12; i++) {
    const production = Math.floor((Math.random() * 2000) + 1000); // Random value between 1000 and 3000 liters
    data.push(production);
  }
  return data;
}

  function getRandomValue() {
    return Math.floor(Math.random() * 50) + 1; // Random value between 1 and 50
  }
</script>
