<div class="MainPage">
<div>
  <canvas id="myChart"></canvas>
  <h1>Milk Production</h1>
  <canvas id="myChart1"></canvas>
  <h1>Feed</h1>
  <canvas id="myChart2"></canvas>
  <h1>Cow Population</h1>
  <canvas id="myChart3"></canvas>
  <h1>Something</h1>
  <canvas id="myChart4"></canvas>
</div>



</div>
</div>

<script>
  const ctx = document.getElementById('myChart');
  const ctx1 = document.getElementById('myChart1');
  const ctx2 = document.getElementById('myChart2');
  const ctx3 = document.getElementById('myChart3');
  const ctx4 = document.getElementById('myChart4');




  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Sick', 'Deaths', 'Pregnant', 'Healthy', 'Something', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
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

  
  new Chart(ctx1, {
    type: 'line',
    data: {
      labels: ['Sick', 'Deaths', 'Pregnant', 'Healthy', 'Something', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
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
  
  new Chart(ctx2, {
    type: 'line',
    data: {
      labels: ['Sick', 'Deaths', 'Pregnant', 'Healthy', 'Something', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
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
</script>
</body>

</html>

