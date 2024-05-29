<?php include'library/dbh.php' ?>
   <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Admin Log</h3>
                <div class="card-tools"></div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  	<th class="text-center">#</th>
						<th>Client</th>
						<th>Ip Address</th>
						<th>Login Time</th>
						<th>Logout</th>
				
                  </thead>
                  <tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT * FROM clientLog");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo $row['client']?></b></td>
						<td><b><?php echo $row['ip'] ?></b></td>
						<td><b><?php echo $row['login'] ?></b></td>
						<td><b><?php echo $row['logout'] ?></b></td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
            <tfoot>
                  <tr>
                   	<th class="text-center">#</th>
					    <th>Client</th>
						<th>Ip Address</th>
						<th>Login Time</th>
						<th>Logout Time</th>
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
  $(function () {
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
  });
</script>