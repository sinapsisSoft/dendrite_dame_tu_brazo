//**************************//
//Author: DIEGO CASALLAS
//Date: 24/08/2019
//Description : Class Table 
//************CLASS TABLE**************//

class Table {

  constructor(id, arrayCell, jSon) {
    this.id = id;
    this.arrayCell = arrayCell;
    this.jSon = jSon;
  }
  //**Method create Table Consents **/
  createtableReport() {
    var objTable = document.getElementById(this.id);
    let objThead = '<thead class="text-wine">';
    let objtbody = '<tbody>';
    let table = "";
    for (let j = 0; j < this.arrayCell.length; j++) {
      objThead += '<th>' + this.arrayCell[j] + '</th>';
    }
    for (let k = 0; k < this.arrayCell.length; k++) {
      if (k == 0) {
        objThead += '<tr>';
      }
      objThead += '<th><input type="text" class="form-control bg-light border-0 small" id="myInput' + k + '" onkeyup="searchTable(' + "'" + this.id + "'," + k + ",'myInput'" + ')" placeholder="Search.." title="Search"></th>';
      if (k == this.arrayCell.length) {
        objThead += '</tr>';
      }
    }
    for (let i = 0; i < this.jSon.length; i++) {
      let mod1 = this.jSon[i].mod_1!= null ? this.jSon[i].mod_1 : "Pendiente";
      let mod2 = this.jSon[i].mod_2!= null ? this.jSon[i].mod_2 : "Pendiente";
      let mod3 = this.jSon[i].mod_3!= null ? this.jSon[i].mod_3 : "Pendiente";
      let mod4 = this.jSon[i].mod_4!= null ? this.jSon[i].mod_4 : "Pendiente";
      objtbody += '<tr>' +
      
        '<td>' + this.jSon[i].user_name + '</td>' +
        '<td>' + this.jSon[i].login_email + '</td>' +
        '<td>' + mod1 + '</td>' +
        '<td>' + mod2 + '</td>' +
        '<td>' + mod3 + '</td>' +
        '<td>' + mod4 + '</td>' +
        '<td>' + this.jSon[i].activity + '</td>' +
        '<th>' +
        '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scoreModal" onclick="setModuleFuntions(' + this.jSon[i].user_id +')"><i class="fab fa-phabricator"></i></button>' +
        '</th></tr>';
    }
    objtbody += '</tbody>';
    objThead += '</thead>';
    table = objThead + objtbody;
    objTable.innerHTML = table;
  }
}

