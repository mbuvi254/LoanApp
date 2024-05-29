<?php
include 'library/dbh.php';
$qry = $conn->query("SELECT * FROM loan_plan where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	if($k == 'months')
		$k = 'months';
	$$k = $v;
}
include 'add_loan_plan.php';
?>