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
    for (let k = 0; k < this.arrayCell.length - 1; k++) {
      if (k == 0) {
        objThead += '<tr>';
      }
      objThead += '<th><input type="text" class="form-control bg-light border-0 small" id="myInput' + k + '" onkeyup="searchTable(' + "'" + this.id + "'," + k + ",'myInput'" + ')" placeholder="Search.." title="Search"></th>';
      if (k == this.arrayCell.length) {
        objThead += '</tr>';
      }
    }
    for (let i = 0; i < this.jSon.length; i++) {
      objtbody += '<tr>' +
        '<td>' + this.jSon[i].Name + '</td>' +
        '<td>' + this.jSon[i].Email + '</td>' +
        '<td>' + this.jSon[i].Phone + '</td>' +
        '<td>' + this.jSon[i].Score + '</td>' +
        // '<td>' + this.jSon[i].Resp_email + '</td>' +
        // '<td>' + this.jSon[i].Attrac_name + '</td>' +
        // '<td>' + this.jSon[i].Consent_date + '</td>' +
        '<th>' +
        '<a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scoreModal"><i class="fab fa-phabricator"></i></a>' +
        '</th></tr>';
    }
    objtbody += '</tbody>';
    objThead += '</thead>';
    table = objThead + objtbody;
    objTable.innerHTML = table;
  }

  createtableScore() {
    var objTable = document.getElementById(this.id);
    let objThead = '<thead class="text-wine">';
    let objtbody = '<tbody>';
    let table = "";
    for (let j = 0; j < this.arrayCell.length; j++) {
      objThead += '<th>' + this.arrayCell[j] + '</th>';
    }
    // for (let k = 0; k < this.arrayCell.length - 1; k++) {
    //   if (k == 0) {
    //     objThead += '<tr>';
    //   }
    //   objThead += '<th><input type="text" class="form-control bg-light border-0 small" id="myInput' + k + '" onkeyup="searchTable(' + "'" + this.id + "'," + k + ",'myInput'" + ')" placeholder="Search.." title="Search"></th>';
    //   if (k == this.arrayCell.length) {
    //     objThead += '</tr>';
    //   }
    // }
    for (let i = 0; i < this.jSon.length; i++) {
      objtbody += '<tr>' +
        '<td>' + this.jSon[i].Name + '</td>' +
        '<td>' + this.jSon[i].Email + '</td>' +
        // '<td>' + this.jSon[i].Phone + '</td>' +
        // '<td>' + this.jSon[i].Score + '</td>' +
        // '<td>' + this.jSon[i].Resp_email + '</td>' +
        // '<td>' + this.jSon[i].Attrac_name + '</td>' +
        // '<td>' + this.jSon[i].Consent_date + '</td>' +
        '</tr>';
    }
    objtbody += '</tbody>';
    objThead += '</thead>';
    table = objThead + objtbody;
    objTable.innerHTML = table;
  }
}

