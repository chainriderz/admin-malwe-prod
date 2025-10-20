/*!
 * Start Bootstrap - SB Admin v4.0.0-beta.2 (https://startbootstrap.com/template-overviews/sb-admin)
 * Copyright 2013-2017 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap-sb-admin/blob/master/LICENSE)
 */

var minDate, maxDate;

// Custom filtering function which will search data in column four between two values
// $.fn.dataTable.ext.search.push(
//     function( settings, data, dataIndex ) {
//         var min = minDate.val();
//         var max = maxDate.val();
//         var date = new Date( data[7] );
 
//         if (
//             ( min === null && max === null ) ||
//             ( min === null && date <= max ) ||
//             ( min <= date   && max === null ) ||
//             ( min <= date   && date <= max )
//         ) {
//             return true;
//         }
//         return false;
//     }
// );

$(document).ready(function() {
    // Create date inputs

    minDate = new DateTime($('#min'), {
        format: 'MMMM Do YYYY'
    });
    maxDate = new DateTime($('#max'), {
        format: 'MMMM Do YYYY'
    });
 
    // DataTables initialisation
    var table = $('#RegisteredDataTable').DataTable();
 
    // Refilter the table
    $('#min').on('change', function () {
        // table.draw();
        alert( 'Column 7 sum: '+
            table.columns(7).search($(this).val()).draw()
                 )            
    });


    $('#max').on('change', function () {
        // table.draw();
        alert( 'Column 8 sum: '+
            table.columns([8]).search($(this).val()).draw()
                 )            
    });
});

$(document).ready(function(){$("#dataTable").DataTable()});