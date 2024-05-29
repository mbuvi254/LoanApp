 <?php include'library/dbh.php'?>
 <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
        
           <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Payment List</h3>
                <div class="card-tools">
        <a class="btn btn-block btn-sm btn-primary btn-flat border-primary" href="./index.php?page=add_payment"><i class="fa fa-plus"></i> Add Payment </a>
      </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th class="text-center">#</th>
                  <th>Loan Id</th>
                  <th>Client</th>
                  <th>Amount</th>
                  <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
          $i = 1;
          $qry = $conn->query("SELECT loan_list.loan_amount,clients.firstname,clients.lastname,payments.id as pid,payments.loan_id,payments.amount FROM payments JOIN loan_list ON payments.loan_id=loan_list.id JOIN clients ON loan_list.loan_client=clients.id");
          while($row= $qry->fetch_assoc()):
          ?>
          <tr>
            <th class="text-center"><?php echo $i++ ?></th>
            <td> <?php echo $row['loan_id'] ?></td>
            <td><b><?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></b></td>
             <td>Ksh. <?php echo number_format($row['amount']) ?></td>
            <td class="text-center">
              
                        <div class="btn-group">
                            <a href="./index.php?page=edit_payment&id=<?php echo $row['pid'] ?>" class="btn btn-primary btn-flat">
                              <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-flat delete_payment" data-id="<?php echo $row['pid'] ?>">
                              <i class="fas fa-trash"></i>
                            </button>
                        </div>
            </td>
          </tr> 
        <?php endwhile; ?>
        </tbody>
                  <tfoot>
                  <tr>
                  <th class="text-center">#</th>
                   <th>Loan Id</th>
                  <th>Client</th>
                  <th>Amount</th>
                  <th>Action</th>
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
  $('.delete_payment').click(function(){
  _conf("Are you sure to delete this payment ?","delete_payment",[$(this).attr('data-id')])
  })
  })
  function delete_payment($id){
    start_load()
    $.ajax({
      url:'ajax.php?action=delete_payment',
      method:'POST',
      data:{id:$id},
      success:function(resp){
        if(resp==1){
          alert_toast("Payment successfully deleted",'success')
          setTimeout(function(){
            location.reload()
          },1500)

        }
      }
    })
  }
</script>