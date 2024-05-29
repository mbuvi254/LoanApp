 <?php include'library/dbh.php'?>
 <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
        
           <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Loans</h3>
                <div class="card-tools">
        <a class="btn btn-block btn-sm btn-primary btn-flat border-primary" href="./index.php?page=add_loan_application"><i class="fa fa-plus"></i> Add Loan Application </a>
      </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th class="text-center">#</th>
                  <th >Loan Id</th>
                  <th>Loan Client</th>
                  <th>Loan Type</th>
                  <th>Loan Amount</th>
                  <th>Loan Status</th>
                  <th>Loan Date</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
          $status= 4;
          $qry = $conn->query("SELECT loan_list.id as lid,loan_types.loanName,loan_list.loan_amount,loan_list.loan_status,loan_list.loan_client,clients.firstname,clients.lastname,loan_list.loan_date FROM loan_list JOIN loan_types ON loan_list.loan_type=loan_types.id JOIN clients ON loan_list.loan_client=clients.id WHERE loan_list.loan_status=$status");
          while($row= $qry->fetch_assoc()):
          ?>
          <tr>
         <td class="text-center"><?php echo $i++ ?></td>
            <td><?php echo $row['lid'];?></td>
            <td> <?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></td>
            <td><b><?php echo $row['loanName'] ?></b></td>
            <td><b>Ksh.<?php echo number_format($row['loan_amount']); ?></b></td>
                <td class="text-center">
                <?php if($row['loan_status'] == 4): ?>
                  <span class="badge badge-danger">Rejected</span>
                <?php endif; ?>
              </td>
            <td><b><?php echo $row['loan_date'] ?></b></td>
            <!----------
            <td class="text-center">
              
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger btn-flat delete_loan" data-id="<?php //echo $row['lid'] ?>">
                              <i class="fas fa-trash"></i>
                            </button>
                        </div>
            </td>----->

          </tr> 
        <?php endwhile; ?>
        </tbody>
                  <tfoot>
                  <tr>
                  <th class="text-center">#</th>
                  <th >Loan Id</th>
                  <th>Loan Client</th>
                  <th>Loan Type</th>
                  <th>Loan Amount</th>
                  <th>Loan Status</th>
                  <th>Loan Date</th>
                 
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
  $('.delete_loan').click(function(){
  _conf("Are you sure to delete this Loan ?","delete_loan",[$(this).attr('data-id')])
  })
  })
  function delete_loan($id){
    start_load()
    $.ajax({
      url:'ajax.php?action=delete_loan',
      method:'POST',
      data:{id:$id},
      success:function(resp){
        if(resp==1){
          alert_toast("Loan successfully deleted",'success')
          setTimeout(function(){
            location.reload()
          },1500)

        }
      }
    })
  }
</script>