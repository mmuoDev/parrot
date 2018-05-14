<div class="summ col-xs-12">
    <table class="col-xs-6">
        <thead><b><th class="col-xs-4">&nbsp;</th><th class="col-xs-4">After Filter</th><th class="col-xs-4">Before Filter</th></b></thead>
        <tr><td colspan="3">&nbsp;</td></tr>
        <tr><td class="col-xs-4"><b>Total Amount (N)</b></td><td  class="col-xs-4"><button  id="amount" class="btn btn-primary"></button></td><td class="col-xs-4"><button  id="amountt" class="btn btn-primary"></button></td></tr>
    </table> 
</div>
<?php if($resa->num_rows>0){?>
<div class="table-responsive col-xs-12">
    <table id="transactions_table" class="table  table-striped table-hover">
        <thead>
            <tr>
            <th>Customer Name</th>
            <!--<th>Address</th>
            <th>GpayRef</th>
            <th>DiscoRef</th>-->
            <th>Account</th>
            <th>Meter</th>
            <th>Type</th>
            <th>Amount</th> 
            <th>Date</th>
            <th>Channel</th>
            <th>HandledBy</th>
            <th>IBC</th>
            <th>Disco</th>
            </tr>
             <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
          </thead>
        
          <?php
          
              while($row = $resa->fetch_array(MYSQLI_ASSOC)){?>
                  <tr>
                    <td><?php echo $row['custname']; ?>
                    <!--<td>--><?php //echo $row['address']; ?><!--</td>-->
                    <!--<td>--><?php //echo $row['gpayRef']; ?><!--</td>-->
                    <!--<td>--><?php //echo $row['discoRef']; ?><!--</td>-->
                    <td><?php echo $row['account']; ?></td>
                    <td><?php echo $row['meter']; ?></td>
                    <td><?php echo $row['custCategory']; ?>
                    <td><?php echo number_format($row['amount'], 2, '.', ','); ?></td> 
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['channel']; ?></td>
                    <td><?php echo $row['handledby']; ?></td>
                    <td><?php echo $row['ibcname']; ?></td>
                    <td><?php echo $row['disco']; ?></td>
                </tr>
             <?php }
          ?>
        </table>
</div>
        <?php }
      else if(isset($resa) && $resa->num_rows == 0) echo "<div class='col-md-12' align='center'><h3>No record found</h3></div>"; ?>
<script>
  $(document).ready(function() {

    $('#transactions_table').DataTable( {
        dom: 'Bfrtip',
            buttons: [
              'csv', 'excel', 'print'
          ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 4, {"filter": "applied"} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            pageTotalf = pageTotal.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
            totalf = total.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
            // Update footer
            /*$( api.column( 4 ).footer() ).html(
                '#'+pageTotalf +' / #'+ totalf
            );*/
            document.getElementById('amount').innerHTML=pageTotalf;
            document.getElementById('amountt').innerHTML=totalf;
        }
    } );

        // new code comes here - this appends the search text for each column

$('#transactions_table thead td').each(function () {
                $(this).html('<input type="text" placeholder="Search" class="form-control" />');
            });

        var table = $('#transactions_table').DataTable();

            // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.header() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );
  </script>
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script> 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed --> 

<script src="../js/bootstrap.js"></script> 
<script src="../js/jqBootstrapValidation.js"></script> 
<script src="../js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>
<script src="../js/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.datatables.net/t/bs/jszip-2.5.0,dt-1.10.11,b-1.1.2,b-colvis-1.1.2,b-html5-1.1.2,b-print-1.1.2,r-2.0.2/datatables.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript" charset="utf-8">
      $(document).ready( function () {
                $.datepicker.regional[""].dateFormat = 'yy/mm/dd';
                $.datepicker.setDefaults($.datepicker.regional['']);

        if ($().datepicker) {   
          $(function() {
            $( "#fromDatepicker" ).datepicker({
              defaultDate: +3
            });

         }); 
          $(function() {
            $( "#toDatepicker" ).datepicker();
         }); 
        }
        $("#daterange-form").hide()
        $("#daterange-form input").prop("disabled", true);

        $("#account-form").hide()
        $("#account-form input").prop("disabled", true);

        $('input[name=s_time_filter]').on('change', function(){
          console.log($(this).val());
          if ($(this).val() != 'all') {
            $('#search-value input').prop('disabled', true);
          }
          else {
            $('#search-value input').prop('disabled', false);
          }
        });

        /*$("#transactions_table").dataTable({
                 dom: 'Bfrtip',
            buttons: [
              'csv', 'excel', 'print'
          ]
        });*/

        $("#chart").hide();
        $("#table-toggle").click(function(){
          $("#chart").hide();
          $("#tab").show();
          return false;
        });        
        $("#chart-toggle").click(function(){
          $("#tab").hide();
          $("#chart").show();
          return false; 
        });
          
      } );
</script>

  

<!-- Javascripts
    ================================================== --> 
<script type="text/javascript" src="../js/main.js"></script>