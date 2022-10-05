/*
*Ahutor:LAURA GRISALES
*Busines: SINAPSIS TECHNOLOGIES
*Date:06/09/2022
*Description:General data view management functions
*/

var userData = new Object();
var userScore = 0;
const DATO = "";
$(".preloader").fadeOut();

function getUserInfo(){
  let getIUserStorage = localStorage.getItem(USER_STORAGE);
  if(getIUserStorage != null && getIUserStorage != "" ){
    userData = JSON.parse(getIUserStorage);
    return true;
  }
}

function onloadView(){
  if(getUserInfo()){    
    validateView(userData);
  }
  else {
    window.location.assign(BASE_URL+"home/login");
  }  
}

function getModule(moduleId){  
  var data = new Object();
  data = {
    module_id: moduleId.slice(-1)
  }
 
  url = BASE_URL + "student/module";   

  fetch(url, {
    method: "POST",
    body: JSON.stringify(data),
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest"
    }
  })
    .then(response => response.text())
    .catch(error => console.error('Error:', error))
    .then(function (response) {

      window.location.assign(BASE_URL + response);
      //alert(response)
    });    
}

function setId(moduleId){
  var data = new Object();
  data = {
    module_id: moduleId.slice(-1)
  }
  url = BASE_URL + "student/module";   
  fetch(url, {
    method: "POST",
    body: JSON.stringify(data),
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest"
    }
  })
    .then(response => response.text())
    .catch(error => console.error('Error:', error))
    .then(function (response) {
      window.location.assign(BASE_URL + "student/module");
    });
}

function getContent(contentType){  
  var data = new Object();
  data = {
    type_content_id: contentType.slice(-1)
  }
  url = BASE_URL + "student/content";   
  fetch(url, {
    method: "POST",
    body: JSON.stringify(data),
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest"
    }
  })
    .then(response => response.text())
    .catch(error => console.error('Error:', error))
    .then(function (response) {
      window.location.assign(BASE_URL + response);
    });    
}

function setInfographic(idInfo){
  let idSelected = idInfo.slice(-1);
  document.getElementById("title-info").innerHTML = `${jsonInfographic[idSelected-1]['content_info_title']}`;
  document.getElementById("img-info").src = `${jsonInfographic[idSelected-1]['content_info_img']}`;
  document.getElementById("pdf-info").innerHTML = `<object data="${jsonInfographic[idSelected-1]['content_info_element']}#toolbar=0" width="100%" height="500px"></object>`;
  document.getElementById("pdf-mobile").href = `${jsonInfographic[idSelected-1]['content_info_element']}`;
}

function backMainModule(){
  $(".preloader").fadeIn();
  window.location.assign(BASE_URL + "student/module");
}

function backDashboard(){
  $(".preloader").fadeIn();
  window.location.assign(BASE_URL + "student/dashboard");
}

function validateAnswer(idForm, event, type){
  $(".preloader").fadeIn();
  let objSTForm = new STForm(idForm);
  if(objSTForm.validateForm()){
    if (type == 0){
      createScore(idForm);
    }
    else if(type == 1){
      createAssessment(idForm);
    }    
  }
  event.preventDefault();
}

function createScore(idForm){
  let objForm = document.getElementById(idForm);
  for (let i = 0; i < objForm.length; i++) {
    let element = objForm[i];
    if(element.type == "radio"){
      if(element.checked){
        let idAnswer = element.id.split("answer");
        let elementFind = jsonQuiz.find(el => el.question_answer_id === idAnswer[1]);
        if(elementFind.question_answer_correct){
          userScore++;
        }        
      }
    }  
  }
  setScore(userScore);
}

function setScore(score){  
  var data = new Object();
  data = {
    user_score_value: score
  }
  url = BASE_URL + "student/quiz";   
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
      let modalBody = document.getElementById("scoreBody");
      if(response[0]['user_score_value'] >= "3"){
        modalBody.innerHTML = `<h3>Bien hecho.</h3><h4>La calificación de tu quiz es de: ${response[0]['user_score_value']}</h4>`;
        var modalScore1 = document.getElementById('scoreModal');
        modalScore1.addEventListener('hidden.bs.modal', function (event) {
          backMainModule();
        }); 
      }
      else {
        modalBody.innerHTML = `<h3>Puedes hacerlo mejor.</h3><h4>La calificación de tu quiz es de: ${response[0]['user_score_value']}</h4><h4>Volvamos a intentarlo</h4>`;
        var modalScore1 = document.getElementById('scoreModal');
        modalScore1.addEventListener('hidden.bs.modal', function (event) {
          window.location.reload();
        }); 
      }
      var modalScore = new bootstrap.Modal(document.getElementById('scoreModal'));
      modalScore.show();
    });    
}

function createAssessment(idForm){
  let objForm = document.getElementById(idForm);
  var data = new Array();  
  for(let i = 0; i < objForm.length; i++){
    if(objForm[i].checked){
      let answerId = objForm[i].id.split("answer");
      let newAnser = {
        question_answer_id: answerId[1]
      }
      data.push(newAnser);
    }
  }
  let objAnswers = {
    answers: data
  }
  setAssessment(objAnswers);
}

function setAssessment(data){  
  url = BASE_URL + "student/assessment";   
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
      // let modalBody = document.getElementById("scoreBody");
      // modalBody.innerHTML = `<h3>Gracias por calificarnos!</h3>`;
      var modalScore = new bootstrap.Modal(document.getElementById('assessmentModal'), {
        keyboard: false,
        backdrop: 'static'
      });
      modalScore.show();
      var modalScore1 = document.getElementById('assessmentModal');
      modalScore1.addEventListener('hidden.bs.modal', function (event) {
        backMainModule();
      }); 
    });    
}

function setLastQuestion(formId, event){
  let objForm = document.getElementById(formId);
  let data = {
    question_answer_id: objForm[0].id,
    user_assessment_detail: objForm[0].value
  };
  url = BASE_URL + "student/lastQuestion";   
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
      let modalBody = document.getElementById("scoreBody");
      let modalFooter = document.getElementById("footerScore");
      modalBody.innerHTML = `<h3>Gracias por calificarnos!</h3>`;
      modalFooter.innerHTML = `<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Salir</button>`;
      var modalScore = new bootstrap.Modal(document.getElementById('assessmentModal'),{
        keyboard: false,
        backdrop: 'static'
      });
      modalScore.show();
      // var modalScore1 = document.getElementById('assessmentModal');
      // modalScore1.addEventListener('hidden.bs.modal', function (event) {
      //   backMainModule();
      // }); 
    }); 
  event.preventDefault();
}

function setActiveModules(){
  if(jsonActivity.length > 0){
    for(let i = 1; i <= jsonActivity[0]['module_id']; i++){
      let divModule = document.getElementById(`module${i}`);
      divModule.classList.remove('div-disabled');
      divModule.addEventListener("click", function(){
        $(".preloader").fadeIn();
        getModule(`module${i}`);
      });
    }
  }  
}

function setActiveContent(moduleId){
  if(jsonActivity.length > 0){
    let modContent = jsonActivity.filter(content => content.module_id == moduleId);
    for(let i = 0; i < modContent.length; i++){
      let divModule = document.getElementById(`content${modContent[i]['type_content_id']}`);
      if(divModule != null && divModule != undefined){
        divModule.classList.remove('div-disabled');
        divModule.addEventListener("click", function(){
          $(".preloader").fadeIn();
          getContent(`content${modContent[i]['type_content_id']}`);        
        });
      }          
    }
  }  
}

function setNotification(){
  let objForm = document.getElementById("formAssesssment");
  for(let i = 0; i < objForm.length; i++){
    if(objForm[i].type == "radio"){
      if(objForm[i].disabled == true){
        let modalBody = document.getElementById("scoreBody");
        let modalFooter = document.getElementById("footerScore");
        modalBody.innerHTML = `<h3>Gracias por calificarnos!</h3>`;
        modalFooter.innerHTML = `<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Salir</button>`;
        var modalScore = new bootstrap.Modal(document.getElementById('assessmentModal'));
        modalScore.show();
        var modalScore1 = document.getElementById('assessmentModal');
        modalScore1.addEventListener('hidden.bs.modal', function (event) {
          backMainModule();
        });
        break;
      }
    }    
  }    
}