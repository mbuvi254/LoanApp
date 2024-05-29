<?php include './lib/dbh.php' ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM clients WHERE id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
}
?>
<div class="container-fluid">
	<table class="table">
		<tr>
			<th>Name:</th>
			<td><b><?php echo ucwords($firstname) ?><?php echo ucwords($lastname) ?></b></td>
		</tr>
		<tr>
			<th>Email:</th>
			<td><b><?php echo $email ?></b></td>
		</tr>
		<tr>
			<th>Contact:</th>
			<td><b><?php echo $contact ?></b></td>
		</tr>
		<tr>
			<th>Loans Taken:</th>
			<td><b><?php $status=2; echo $conn->query("SELECT distinct(loan_client) FROM loan_list  where loan_client = {$_GET['id']} AND loan_status=$status")->num_rows; ?></b></td>
		</tr>
	</table>
</div>
<div class="modal-footer display p-0 m-0">
        <a href="index.php?page=client_list" class="btn btn-secondary btn-flat btn-block">Client List</a>
</div>
