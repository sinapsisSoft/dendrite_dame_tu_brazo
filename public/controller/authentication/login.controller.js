/*
*Ahutor:LAURA GRISALES
*Busines: SINAPSIS TECHNOLOGIES
*Date:06/09/2022
*Description:General login management functions
*/
const btnLogin = document.getElementById('btn_send');
const objForm = document.getElementById('objForm');
var url = "";
var objSTFrom;
var stringData;
var formData = new Object();

var primaryId = 'crop_activities_id';
var arRoutes = new Array('create', 'edit', 'update', 'delete');
var arMessages = new Array('New Creation', 'edit', 'Update Done', 'Item Deletion Done');
var ruteContent = "crop_activities/";
var nameModel = 'cropsActivities';
var assignmentAction = 0;
const urlbase = BASE_URL + ruteContent;



$(".preloader").fadeOut();

function sendDataForm(idForm, e) {
  objSTFrom = new STForm(idForm);
  if (!objSTFrom.validateForm()) {
    alert("Validate data");
  }
  else {
    formData = objSTFrom.getDataForm();
    login();
  }
  e.preventDefault();
}
function onloadView() {
  localStorage.clear();
}
function login() {

  url = BASE_URL + "login/login";
  fetch(url, {
    method: "POST",
    body: JSON.stringify(formData),
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest"
    }
  })
    .then(response => response.json())
    .catch(error => console.error('Error:', error))
    .then(response => {
      if (Object.keys(response['user']).length==0) {
        alert('Validar Usuario o Contraseña');
      } else {
        stringData = `{"user_id":"${response['user'][0].user_id}", "role_id":"${response['user'][0].role_id}"}`;
        localStorage.setItem(USER_STORAGE, stringData);
        window.location.assign(BASE_URL + "home/home");
      }
    });
  
}

function logOut() {
  localStorage.clear();
  url = BASE_URL + "login/logout";
  fetch(url, {
    method: "POST",
    body: "",
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

