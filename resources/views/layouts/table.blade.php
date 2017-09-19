
    <!-- Datatables -->
    <script src="{{ asset ('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset ('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset ('vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset ('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{ asset ('vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{ asset ('vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset ('vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset ('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{ asset ('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{ asset ('vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset ('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{ asset ('vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{ asset ('vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{ asset ('vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{ asset ('vendors/pdfmake/build/vfs_fonts.js')}}"></script>

 	<!-- iCheck -->
    <script src="{{ asset ('vendors/iCheck/icheck.min.js')}}"></script>
    <!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#example").length) {
            //$("#example")
          }
        };

        var $datatable = $('#example').DataTable({
            dom: '<"top">flt<"bottom"><br/><br/>i<br/><br/><br/>pB',
            stateSave: true,
            buttons: [              
              {
                extend: "csv",
                className: "btn-sm"
              },
              {
                extend: "excel",
                className: "btn-sm"
              },
              /*{
                extend: "pdfHtml5",
                className: "btn-sm"
              },*/
              {
                extend: "print",
                className: "btn-sm"
              },
            ],
            responsive: true,
            order: [[ 1, 'asc' ]]            
          });

        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();
        TableManageButtons.init();
      });
    </script>