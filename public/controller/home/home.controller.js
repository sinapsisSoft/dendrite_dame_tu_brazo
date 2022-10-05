/*
*Ahutor:LAURA GRISALES
*Busines: SINAPSIS TECHNOLOGIES
*Date:06/09/2022
*Description:General data view management functions
*/
var userData = new Object();
var numTreatment = 2;
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
    window.location.assign(BASE_URL+"login/view");
  }  
}

function validateView(formData) {
  // $(".preloader").fadeIn();
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
      console.log(response);
      //numTreatment = parseInt(response[0]);      
        $(".preloader").fadeOut();
        window.location.assign(BASE_URL + response[1]); 
       
      
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
      if(response[0]["sum"] == numTreatment){
        $(".preloader").fadeIn();
        window.location.assign(BASE_URL+"student/dashboard");
      }        
    });
}