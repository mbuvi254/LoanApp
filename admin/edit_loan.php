<?php
include 'library/dbh.php';
$qry = $conn->query("SELECT * FROM loan_list where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	if($k == 'loan_amount')
		$k = 'loan_amount';
	$$k = $v;
}
include 'add_loan_application.php';
?>