
  var ctx = document.getElementById('chart1');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
      ],
      datasets: [{
        label: 'My First dataset',
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        data: [0, 10, 5, 2, 20, 30, 45],
      }]
    },

    options: {}
  });



  var ctx = document.getElementById('chart2');
  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: labels = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
      ],
      datasets: [{
        label: 'My First dataset',
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        data: [0, 10, 5, 2, 20, 30, 45],
      }]
    },

    options: {}
  });






// function drawChart1(chartId, type, jsonData) {
//   var myChart;
//   if(first > 0){
//     document.getElementById(chartId).remove();
//     let canvas = document.createElement('canvas');
//     canvas.setAttribute('id',chartId);
//     canvas.setAttribute('width','100%');
//     document.querySelector('#'+chartId+'Report').appendChild(canvas);
//   }
//   var ctx = document.getElementById(chartId);
//   myChart = new Chart(ctx, {
//     type: type,
//     data: {
//       datasets: [{
//         label: '# Reservas del mes ',
//         data: jsonData,
//         backgroundColor: [
//           'rgba(255, 99, 132, 0.2)',
//           'rgba(54, 162, 235, 0.2)',
//           'rgba(255, 206, 86, 0.2)',
//           'rgba(75, 192, 192, 0.2)',
//           'rgba(153, 102, 255, 0.2)',
//           'rgba(255, 159, 64, 0.2)'
//         ],
//         borderColor: [
//           'rgba(255, 99, 132, 1)',
//           'rgba(54, 162, 235, 1)',
//           'rgba(255, 206, 86, 1)',
//           'rgba(75, 192, 192, 1)',
//           'rgba(153, 102, 255, 1)',
//           'rgba(255, 159, 64, 1)'
//         ],
//         borderWidth: 1
//       }]
//     },
//     options: {
//       parsing: {
//         xAxisKey: 'Res_month',
//         yAxisKey: 'Res_totalM'
//       }
//     }
//   });
// }

// function drawChart2(chartId, type, jsonData) {
//   var myChart;
//   if(first > 0){
//     document.getElementById(chartId).remove();
//     let canvas = document.createElement('canvas');
//     canvas.setAttribute('id',chartId);
//     canvas.setAttribute('width',' 100%');
//     char = document.querySelector('#'+chartId+'Report');
//     document.getElementById(chartId+'Report').appendChild(canvas);
//   }
//   var ctx = document.getElementById(chartId);
//   myChart = new Chart(ctx, {
//     type: type,
//     data: {
//       datasets: [{
//         label: 'Número reservas del día',
//         data: jsonData,
//         backgroundColor: [
//           'rgba(255, 99, 132, 0.2)',
//           'rgba(54, 162, 235, 0.2)',
//           'rgba(255, 206, 86, 0.2)',
//           'rgba(75, 192, 192, 0.2)',
//           'rgba(153, 102, 255, 0.2)',
//           'rgba(255, 159, 64, 0.2)'
//         ],
//         borderColor: [
//           'rgba(255, 99, 132, 1)',
//           'rgba(54, 162, 235, 1)',
//           'rgba(255, 206, 86, 1)',
//           'rgba(75, 192, 192, 1)',
//           'rgba(153, 102, 255, 1)',
//           'rgba(255, 159, 64, 1)'
//         ],
//         borderWidth: 1
//       }]
//     },
//     options: {
//       parsing: {
//         xAxisKey: 'Res_day',
//         yAxisKey: 'Res_totalW'
//       },
//       plugins: {
//         title: {
//             display: true,
//             text: 'Número de reservas por día de la semana'
//         }
//       }
//     }
//   });
// }