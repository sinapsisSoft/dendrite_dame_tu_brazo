/*
*Ahutor:DIEGO CASALLAS
*Busines: SINAPSIS TECHNOLOGIES
*Date:16/05/2022
*Description:Form validation libraries
*Vesion:1.0
*/
class STForm {
  //Class variables
  //Constructor method
  constructor(formObj) {
    this.objectForm = document.getElementById(formObj);
    this.objectInput = null;
    this.elementsForm = this.objectForm.length;
    this.elementJson = {};
    this.inputValue = null;
    this.arrayTypeInput = new Array("checkbox", "color", "date", "datetime-local", "email", "file", "hidden", "image", "month", "number", "password", "radio", "range", "reset", "search", "tel", "text", "time", "textarea", "url", "week");
    this.vaslidateInput = true;
    this.textSubmit = "submit";
    this.textButton = "button";
    this.textSelect = "select-one";
    this.textRadio = "radio";
    this.textImg = "image";
    this.objJson = null;
    this.dataLengthJson = 0;
    this.objElementInput = null;
    this.postData = new FormData();
  }
  /*
  *Ahutor:DIEGO CASALLAS
  *Busines: SINAPSIS TECHNOLOGIES
  *Date:17/05/2022
  *Description:Get form data
  */
  getDataForm() {
    for (let i = 0; i < this.elementsForm; i++) {

      if (!((this.objectForm[i].type == this.textSubmit) || (this.objectForm[i].type == this.textButton))) {

        if (this.objectForm[i].getAttribute("src") != null) {


          this.elementJson[this.objectForm[i].id] = this.objElementInput.src;

        } else {
          if (this.objectForm[i].type == this.arrayTypeInput[0]) {
            if (this.objectForm[i].checked) {
              this.elementJson[this.objectForm[i].id] = true;
            }
            else {
              this.elementJson[this.objectForm[i].id] = false;
            }
          } else if (this.objectForm[i].type == this.textSelect) {
            this.elementJson[this.objectForm[i].id] = this.objectForm[i].value;
          } else if (this.objectForm[i].type == this.textRadio) {
            if (this.objectForm[i].checked) {
              this.elementJson[this.objectForm[i].name] = this.objectForm[i].value;
            }
          }
          else if (this.objectForm[i].required) {
            this.elementJson[this.objectForm[i].id] = this.objectForm[i].value;
          } else {
            this.elementJson[this.objectForm[i].id] = this.objectForm[i].value;
          }
        }


      }
    }
    return this.elementJson;
  }
  /*
  *Ahutor:DIEGO CASALLAS
  *Busines: SINAPSIS TECHNOLOGIES
  *Date:17/05/2022
  *Description:Get form data
  */
  getFormData() {
    for (let i = 0; i < this.elementsForm; i++) {
      if (!((this.objectForm[i].type == this.textSubmit) || (this.objectForm[i].type == this.textButton))) {


        if (this.objectForm[i].type == this.arrayTypeInput[0]) {
          if (this.objectForm[i].checked) {
            this.elementJson[this.objectForm[i].id] = true;
          }
          else {
            this.elementJson[this.objectForm[i].id] = false;
          }
        } else if (this.objectForm[i].type == this.textSelect) {

          this.postData.append(this.objectForm[i].name, this.objectForm[i].value);
        } else if (this.objectForm[i].type == this.textRadio) {
          if (this.objectForm[i].checked) {

            this.postData.append(this.objectForm[i].name, this.objectForm[i].value);
          }
        }
        else if (this.objectForm[i].type == this.arrayTypeInput[5]) {

          this.postData.append(this.objectForm[i].name, this.objectForm[i].files[0]);


        }
        else if (this.objectForm[i].required) {

          this.postData.append(this.objectForm[i].name, this.objectForm[i].value);
        } else {

          this.postData.append(this.objectForm[i].name, this.objectForm[i].value);
        }
      }
    }

    return this.postData;
  }
  /*
  *Ahutor:DIEGO CASALLAS
  *Busines: SINAPSIS TECHNOLOGIES
  *Date:17/05/2022
  *Description:Form data validations requered, empty or with spaces
  */
  validateInput(input) {

    this.vaslidateInput = true;
    this.inputValue = input.value.trim();
    if (input.required) {
      switch (input.type) {
        case this.arrayTypeInput[0]:
          break;
        case this.arrayTypeInput[1]:
          break;
        case this.arrayTypeInput[2]:
          break;
        case this.arrayTypeInput[3]:
          break;
        case this.arrayTypeInput[4]:
          if (this.inputValue == "" || this.inputValue.length == 0) {
            this.vaslidateInput = false;
            input.focus();
            break;
          }
          break;
        case this.arrayTypeInput[5]:
          if (this.inputValue == "" || this.inputValue.length == 0) {
            this.vaslidateInput = false;
            input.focus();
            break;
          }
          break;
        case this.arrayTypeInput[6]:
          break;
        case this.arrayTypeInput[7]:
          break;
        case this.arrayTypeInput[8]:
          break;
        case this.arrayTypeInput[9]:
          if (this.inputValue == "" || this.inputValue.length == 0) {
            this.vaslidateInput = false;
            input.focus();
            break;
          }
          break;
        case this.arrayTypeInput[10]:
          if (this.inputValue == "" || this.inputValue.length == 0) {
            this.vaslidateInput = false;
            input.focus();
            break;
          }
          break;
        case this.arrayTypeInput[16]:
          if (this.inputValue == "" || this.inputValue.length == 0) {
            this.vaslidateInput = false;
            input.focus();
            break;
          }
          break;
        case this.arrayTypeInput[18]:
          if (this.inputValue == "" || this.inputValue.length == 0) {
            this.vaslidateInput = false;
            input.focus();
            break;
          }
          break;
      }

    }

    return this.vaslidateInput;
  }
  /*
  *Ahutor:DIEGO CASALLAS
  *Busines: SINAPSIS TECHNOLOGIES
  *Date:17/05/2022
  *Description:Add data in the form, these functions validate the identification of the Html input with the json key to insert data in each Html element with the value that the Json has
  */
  setDataForm(dataJson, idForm) {
    this.objectForm = document.getElementById(idForm);
    this.objJson = Object.keys(dataJson);

    this.dataLengthJson = this.objJson.length;
    for (let i = 0; i < this.dataLengthJson; i++) {
      this.objElementInput = null;
      this.objElementInput = document.getElementById(this.objJson[i]);
      if (this.objElementInput.getAttribute("src") != null) {
        this.objElementInput.src = ROUTE_FILE_VIEW_UPLOADS + dataJson[this.objJson[i]];
        this.objElementInput.value = dataJson[this.objJson[i]];
      } else {
        if (this.objectForm[i].type == this.arrayTypeInput[0]) {
          this.objElementInput = document.getElementById(this.objJson[i]);
          this.objElementInput.checked = dataJson[this.objJson[i]];
        } else if (this.objectForm[i].type == this.textRadio) {
          this.objElementInput = document.getElementsByName(this.objJson[i]);
          for (let j = 0; j < this.objElementInput.length; j++) {
            if (this.objElementInput[j].value == dataJson[this.objJson[i]]) {
              this.objElementInput[j].checked = true;
            } else {
              this.objElementInput[j].checked = false;
            }
          }
        }
        else {
          this.objElementInput = document.getElementById(this.objJson[i])
          this.objElementInput.value = dataJson[this.objJson[i]];
        }
      }
    }
  }
  /*
  *Ahutor:DIEGO CASALLAS
  *Busines: SINAPSIS TECHNOLOGIES
  *Date:17/05/2022
  *Description:This function clear the form
  */
  clearDataForm(idForm) {
    this.objectForm = document.getElementById(idForm);
    this.objectForm.value = "";
    this.objectForm.reset();
  }
  /*
  *Ahutor:DIEGO CASALLAS
  *Busines: SINAPSIS TECHNOLOGIES
  *Date:17/05/2022
  *Description:This function clear the form
  */
  validateForm() {

    for (let i = 0; i < this.elementsForm; i++) {
      if (!this.validateInput(this.objectForm[i])) {

        return false;
      }

    }
    return true;
  }

}
