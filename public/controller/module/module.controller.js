/*
*Ahutor:LAURA GRISALES
*Busines: SINAPSIS TECHNOLOGIES
*Date:06/09/2022
*Description:General user data treatment management functions
*/
var userData = new Object();
var numTreatment = 0;

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

function validateView(formData) {
  url = BASE_URL + "home/validateView";  
  fetch(url, {
    method: "POST",
    body: JSON.stringify(formData),
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest"
    }
  })
    .then(response => response.text())
    .catch(error => console.error('Error:', error))
    .then(function (response) {
      response = response.split(",");
      numTreatment = parseInt(response[0]);
      if(BASE_URL+response[1] != window.location.href){
        window.location.assign(BASE_URL + response[1]);
      }      
    });
}

function acceptTreatment(type) {  
  url = BASE_URL + "home/accept";  
  getUserInfo();
  var data = new Object();
  data = {
    user_id: userData.user_id,
    type_id: type
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
      numTreatment += parseInt(response[0]["Success"]);
      if(numTreatment == 2){
        window.location.assign(BASE_URL+"student/dashboard");
      }        
    });
}