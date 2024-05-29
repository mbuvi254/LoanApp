<?php
include 'library/dbh.php';
$qry = $conn->query("SELECT * FROM payments where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	if($k == 'amount')
		$k = 'amount';
	$$k = $v;
}
include 'add_payment.php';
?>