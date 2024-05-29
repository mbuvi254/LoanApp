   <?php include'lib/dbh.php'?>
   <section class="content py-5">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
        
           <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Payment Schedule</h3>
                <div class="card-tools">
      
               </div>
              </div>
       
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Loan Id</th>
                        <th>Month</th>
                        <th>Monthly Payment</th>
                        <th>Monthly Interest</th>
                        <th>Monthly Principal</th>
                        <th>Remaining Loan Amount</th>
                        <th>Total Paid</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php
                    $i = 1;
                    $qry = $conn->query("SELECT * FROM loan_schedule WHERE loan_id={$_GET['id']};");
                    while($row= $qry->fetch_assoc()):
                    ?>
          <tr>
             <td><?php echo $row['loan_id']; ?></td>
                            <td><?php echo $row['month']; ?></td>
                            <td><?php echo $row['monthly_payment']; ?></td>
                            <td><?php echo $row['monthly_interest']; ?></td>
                            <td><?php echo $row['monthly_principal']; ?></td>
                            <td><?php echo $row['remaining_loan_amount']; ?></td>
                            <td><?php echo $row['total_paid']; ?></td>
    
          </tr> 
        <?php endwhile; ?>
        </tbody>
                  <tfoot>
                  <tr>
                     <th>Loan Id</th>
                        <th>Month</th>
                        <th>Monthly Payment</th>
                        <th>Monthly Interest</th>
                        <th>Monthly Principal</th>
                        <th>Remaining Loan Amount</th>
                        <th>Total Paid</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->


    
<script>
	$(document).ready(function(){
		$('#list').dataTable()
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  })
</script>