<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}

if($action == 'save_loan_type'){
	$save = $crud->save_loan_type();
	if($save)
		echo $save;
}

if($action == 'delete_loan_type'){
	$save = $crud->delete_loan_type();
	if($save)
		echo $save;
}

if($action == 'save_loan_plan'){
	$save = $crud->save_loan_plan();
	if($save)
		echo $save;
}

if($action == 'delete_loan_plan'){
	$save = $crud->delete_loan_plan();
	if($save)
		echo $save;
}

if($action == 'save_client'){
	$save = $crud->save_client();
	if($save)
		echo $save;
}
if($action == 'delete_client'){
	$save = $crud->delete_client();
	if($save)
		echo $save;
}

if($action == 'save_loan'){
	$save = $crud->save_loan();
	if($save)
		echo $save;
}
if($action == 'delete_loan'){
	$save = $crud->delete_loan();
	if($save)
		echo $save;
}
if($action == 'save_loan_schedule'){
	$save = $crud->save_loan_schedule();
	if($save)
		echo $save;
}
if($action == 'save_payment'){
	$save = $crud->save_payment();
	if($save)
		echo $save;
}
if($action == 'delete_payment'){
	$save = $crud->delete_payment();
	if($save)
		echo $save;
}

if($action == 'save_admin'){
	$save = $crud->save_admin();
	if($save)
		echo $save;
}
if($action == 'delete_admin'){
	$save = $crud->delete_admin();
	if($save)
		echo $save;
}






ob_end_flush();
?>
