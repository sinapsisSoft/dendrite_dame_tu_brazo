
var arrayCell = new Array("Usuario","Identificación", "Módulo 1", "Módulo 2", "Módulo 3", "Módulo 4", "Última actividad");
var first = 0;

function searchReport(event){
  $(".preloader").fadeIn();
  let finDate = document.getElementById('finDate').value;
  getChart1(finDate);
  getChart2();
  event.preventDefault();
}

function getChart1(finDate) {  
  url = BASE_URL + "admin/chart1";  
  var data = new Object();
  data = {
    finDate: finDate
  }
  fetch(url, {
    method: "POST",
    body: JSON.stringify(data),
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest"
    }
  })
    .then(response => response.json())
    .catch(error => console.error('Error:', error))
    .then(function (response) {      
      chart1(response);      
      getTable(finDate);
      first++;
    });
}

function getChart2() {  
  url = BASE_URL + "admin/chart2";  
  fetch(url, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest"
    }
  })
    .then(response => response.json())
    .catch(error => console.error('Error:', error))
    .then(function (response) {      
      chart2(response);
      // first++;
    });
}

function getTable(finDate) {  
  url = BASE_URL + "admin/table";  
  var data = new Object();
  data = {
    finDate: finDate
  }
  fetch(url, {
    method: "POST",
    body: JSON.stringify(data),
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest"
    }
  })
    .then(response => response.json())
    .catch(error => console.error('Error:', error))
    .then(function (response) {
      $(".preloader").fadeOut();
      tableReport = new Table('tableStudentReport', arrayCell, response);
      tableReport.createtableReport(); 
    });
}

function getUserReport(userId, moduleId) {  
  $(".preloader").fadeIn();
  url = BASE_URL + "admin/user";  
  var data = new Object();
  data = {
    user_id: userId,
    module_id: moduleId
  }
  fetch(url, {
    method: "POST",
    body: JSON.stringify(data),
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest"
    }
  })
    .then(response => response.json())
    .catch(error => console.error('Error:', error))
    .then(function (response) {
      assessment(response, moduleId)  ;
      $(".preloader").fadeOut();
    });
}

function chart1(response){
  if(first > 0){
    document.getElementById('chart1').remove();
    let canvas = document.createElement('canvas');
    canvas.setAttribute('id','chart1');
    canvas.setAttribute('width','100%');
    document.querySelector('#chart1'+'Report').appendChild(canvas); 
  }
  var ctx = document.getElementById('chart1');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      datasets: [{
        label: 'Estudiantes por módulo',
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)'
        ],
        data: response
      }]
    },

    options: {
      parsing: {
        xAxisKey: 'module_id',
        yAxisKey: 'module_count'
      },
      plugins: {
        title: {
          display: true,
          text: 'Cantidad de estudiantes por módulo',
        }
      }
    }
  });
}

function setModuleFuntions(userId){
  for(let i = 1; i < 5; i++){    
    let module = document.getElementById(`nav-modulo-${i}-tab`);
    module.addEventListener("click", function(){
      getUserReport(userId, i);      
    });
  }
  getUserReport(userId, 1);
}

function assessment(json, moduleId){  
  let titleAssessment = document.getElementById(`assessment-title-${moduleId}`);
  let divAssessment = document.getElementById(`assessment-${moduleId}`);  
  titleAssessment.innerHTML = "";
  divAssessment.innerHTML = "";  
  if(json.length > 0){  
  titleAssessment.innerHTML = `Encuesta del módulo ${moduleId}:`;
  let table = `<table class="table table-hover">
	<thead>
		<tr>
			<th>Pregunta</th>
			<th>Respuesta</th>
		</tr>
  </thead>
	<tbody>`;
  let tablebody = "";
  for(let i = 0; i < json.length; i++){
    let answer = json[i]['answer_text'] != null ? json[i]['answer_text'] : json[i]['user_assessment_detail'];
    tablebody += `<tr>
              <td>${json[i]['question_text']}</td>
              <td>${answer}</td>
            </tr>`;          
  }
  let tableend = `</tbody>
  </table>`;
  divAssessment.innerHTML = table + tablebody + tableend;
  }
  else {
    titleAssessment.innerHTML = "Aún no diligenciada";
    divAssessment.innerHTML = "";
  }
  
}

function chart2(data){
  if(first > 0){
    document.getElementById('chart2').remove();
    let canvas = document.createElement('canvas');
    canvas.setAttribute('id','chart2');
    canvas.setAttribute('width','100%');
    document.querySelector('#chart2'+'Report').appendChild(canvas); 
  }
  var ctx = document.getElementById('chart2');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Módulo 1','Módulo 2', 'Módulo 3', 'Módulo 4'],
      datasets: [
        {
          label: 'Pregunta 1',
          data: data[0],
          backgroundColor: 'rgba(255, 99, 132, 0.5)',
        },
        {
          label: 'Pregunta 2',
          data: data[1],
          backgroundColor: 'rgb(54, 162, 235, 0.5)',
        },
        {
          label: 'Pregunta 3',
          data: data[2],
          backgroundColor: 'rgb(75, 192, 192, 0.5)',
        },
        {
          label: 'Pregunta 4',
          data: data[3],
          backgroundColor: 'rgb(255, 159, 64, 0.5)',
        },
        {
          label: 'Pregunta 5',
          data: data[4],
          backgroundColor: 'rgb(153, 102, 255, 0.5)',
        }
      ]
    },
   options: {
    plugins: {
      title: {
        display: true,
        text: 'Calificación promedio de la evaluación de cada módulo',
      }
    }
   }
  });
}

  