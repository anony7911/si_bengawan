require('./bootstrap');

import $ from 'jquery';
window.$ = window.jQuery = $;



import'admin-lte/plugins/datatables/jquery.dataTables.min.js';

import'admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js';
import'admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js';
import'admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js';
import'admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js';
import'admin-lte/plugins/select2/js/select2.full.min.js';

import'admin-lte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js';
import'admin-lte/plugins/bootstrap-switch/js/bootstrap-switch.min.js';


//Don't forgot to put code also same as below otherwise it will not working

// Datepicket Code
$('#datepicker').datepicker();

//Datatable
$("#example1").DataTable({
    "responsive": true,
    "autoWidth": false,
  });

//Initialize Select2 Elements
$('.select2').select2()

//Initialize Select2 Elements
$('.select2bs4').select2({
    theme: 'bootstrap4'
})
// ..........similarly other scripts comes

