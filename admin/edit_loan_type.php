<?php
include './library/dbh.php';
$qry = $conn->query("SELECT * FROM loan_types where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	if($k == 'loanName')
		$k = 'loanName';
	$$k = $v;
}
include 'add_loan_type.php';
?>