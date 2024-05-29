 <?php include'library/dbh.php'?>
 <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
        
           <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Loan Plans</h3>
                <div class="card-tools">
        <a class="btn btn-block btn-sm btn-primary btn-flat border-primary" href="./index.php?page=add_loan_plan"><i class="fa fa-plus"></i> Add Loan Plan </a>
      </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th class="text-center">#</th>
                  <th>Loan Months</th>
                  <th>Loan Interest</th>
                  <th>Loan Penalty</th>
                  <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
          $i = 1;
          $qry = $conn->query("SELECT * FROM loan_plan");
          while($row= $qry->fetch_assoc()):
          ?>
          <tr>
            <th class="text-center"><?php echo $i++ ?></th>
            <td> <?php echo $row['months'] ?></td>
            <td><b><?php echo $row['interest_percentage'] ?></b></td>
             <td><b><?php echo $row['penalty_rate'] ?></b></td>
            <td class="text-center">
              
                        <div class="btn-group">
                            <a href="./index.php?page=edit_loan_plan&id=<?php echo $row['id'] ?>" class="btn btn-primary btn-flat">
                              <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-flat delete_loan_plan" data-id="<?php echo $row['id'] ?>">
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
               <th>Loan Months</th>
                  <th>Loan Interest</th>
                  <th>Loan Penalty</th>
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
  $('.delete_loan_plan').click(function(){
  _conf("Are you sure you want to delete this Loan Plan ?","delete_loan_plan",[$(this).attr('data-id')])
  })
  })
  function delete_loan_plan($id){
    start_load()
    $.ajax({
      url:'ajax.php?action=delete_loan_plan',
      method:'POST',
      data:{id:$id},
      success:function(resp){
        if(resp==1){
          alert_toast("Loan Plan successfully deleted",'success')
          setTimeout(function(){
            location.reload()
          },1500)

        }
      }
    })
  }
</script>