function fnExcelReport(tableName,reportName) {
  let table = document.getElementById(tableName).innerHTML;
  var tab_text = '<html xmlns:x="urn:schemas-microsoft-com:office:excel"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">';
  tab_text = tab_text + '<head><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>';

  tab_text = tab_text + '<x:Name>' + reportName +'</x:Name>';

  tab_text = tab_text + '<x:WorksheetOptions><x:Panes></x:Panes></x:WorksheetOptions></x:ExcelWorksheet>';
  tab_text = tab_text + '</x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body>';

  tab_text = tab_text + "<table border='1px'>";
  tab_text = tab_text + table;
  tab_text = tab_text + '</table></body></html>';
  tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, "");

  var data_type = 'data:application/vnd.ms-excel;charset=UTF-8';
  
  var ua = window.navigator.userAgent;
  var msie = ua.indexOf("MSIE ");
  
  if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
      if (window.navigator.msSaveBlob) {
          var blob = new Blob([tab_text], {
              type: "text/plain;charset=utf-8;"
          });
          navigator.msSaveBlob(blob, 'reporteExpedientes.xls');
      }
  } else {
      $('#btnExcel').attr('href', data_type + ', ' + encodeURIComponent(tab_text));
      $('#btnExcel').attr('download', reportName + '.xls');
  }

}