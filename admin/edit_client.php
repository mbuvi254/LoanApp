<?php
include 'library/dbh.php';
$qry = $conn->query("SELECT * FROM clients where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
include 'add_client.php';
?>