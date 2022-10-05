//**************************//
//Author: DIEGO CASALLAS
//Date: 23/05/2020
//Description : funtions filter Client
//************GET DATA FORM**************//
function searchTable(objTable,cell,inputName) {
  var input, filter, table, tr, td, i, txtValue;
  table = document.getElementById(objTable);
  //input = document.getElementById("myInput"+cell);
  input = document.getElementById(inputName+cell);
  filter = input.value.toUpperCase();  
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[cell];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
