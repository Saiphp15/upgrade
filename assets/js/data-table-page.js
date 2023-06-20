$(document).ready(function () {
    let base_url = window.location.origin;
    if(base_url == "http://localhost"){
        base_url= '/upgrade';        
    }else{
        base_url;
    } 

    $(function () {
        $('#studentDatatableList').DataTable({
          'paging': true,
          'deferRender': true,
          'lengthChange': true,
          'searching': true,
          'info': true,
          'dom': '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',
          'buttons': [
              'copy', 'csv', 'excel', 'pdf', 'print' 
          ],
          'pageLength': 10,
          'processing': true,
        });
    });

    $(function () {
        $('#subjectDatatableList').DataTable({
          'paging': true,
          'deferRender': true,
          'lengthChange': true,
          'searching': true,
          'info': true,
          'dom': '<"container-fluid"<"row"<"col-sm-6"B><"col-sm-4"f><"col-sm-1"l >>>rtip',
          'buttons': [
              'copy', 'csv', 'excel', 'pdf', 'print' 
          ],
          'pageLength': 10,
          'processing': true,
        });
    });

    
    
});

