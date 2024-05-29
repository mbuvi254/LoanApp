<?php
include 'library/dbh.php';
$qry = $conn->query("SELECT * FROM admin where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
include 'new_admin.php';
?>