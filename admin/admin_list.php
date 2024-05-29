<?php include'./lib/dbh.php' ?>
   <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Adminstrators List</h3>
                <div class="card-tools">
				<a class="btn btn-block btn-sm btn-primary btn-flat border-primary" href="./index.php?page=new_admin"><i class="fa fa-plus"></i> Add New Admin</a>
			</div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  	<th class="text-center">#</th>
						<th>Name</th>
						<th>Contact #</th>
						<th>Email</th>
						<th>Action</th>
                  </thead>
                  <tbody>
					<?php
					$i = 1;
				
					$qry = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM admin order by concat(lastname,', ',firstname,' ',middlename) asc");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo ucwords($row['name']) ?></b></td>
						<td><b><?php echo $row['contact'] ?></b></td>
						<td><b><?php echo $row['email'] ?></b></td>
						<td class="text-center">
		                  
		          <a class="btn btn-flat btn-secondary" href="./index.php?page=view_admin&id=<?php echo $row['id'] ?>"><i class="fa fa-eye"></i></a>
		                    
		             <a class="btn btn-flat btn-primary" href="./index.php?page=edit_admin&id=<?php echo $row['id'] ?>"><i class="fa fa-pen"></i></a>
		                     
		                <button type="button" class="btn btn-danger btn-flat delete_admin" data-id="<?php echo $row['id'] ?>">
                            <i class="fa fa-trash"></i>
                            </button>
		                       
		                  
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
                  <tfoot>
                  <tr>
                   	<th class="text-center">#</th>
						<th>Name</th>
						<th>Contact #</th>
						<th>Email</th>
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
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

  $('.delete_admin').click(function(){
  _conf("Are you sure to delete this Admin ?","delete_admin",[$(this).attr('data-id')])
  })
  })
  function delete_admin($id){
    start_load()
    $.ajax({
      url:'ajax.php?action=delete_admin',
      method:'POST',
      data:{id:$id},
      success:function(resp){
        if(resp==1){
          alert_toast("Admin successfully deleted",'success')
          setTimeout(function(){
            location.reload()
          },1500)

        }
      }
    })
  }
</script>