<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include './lib/dbh.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);
			$qry = $this->db->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM clients where (email = '".$uid."' OR contact = '".$uid."') and password = '".md5($password)."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['user_'.$key] = $value;
				
			}
			$uip=$_SERVER['REMOTE_ADDR'];
			$log = $this->db->query("INSERT INTO clientLog (client,ip)VALUES('$uid','$uip')");
		return 1;

	}else{
			return 3;
		}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			date_default_timezone_set('Africa/Nairobi');
			$ldate=date("Y-m-d H:i:s");
			$log = $this->db->query("UPDATE clientLog  SET logout = '$ldate' WHERE client = '".$_SESSION['user_email']."' ORDER BY id DESC LIMIT 1");
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
   function save_client(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass')) && !is_numeric($k)){
				if($k =='password')
					$v = md5($v);
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		$check = $this->db->query("SELECT * FROM clients where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO clients set $data");
		}else{
			$save = $this->db->query("UPDATE clients set $data where id = $id");
		}

		if($save){
			return 1;
		}
	}
	
	function update_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','table')) && !is_numeric($k)){
				if($k =='password')
					$v = md5($v);
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		$check = $this->db->query("SELECT * FROM clients where email ='$email' ".(!empty($id) ? " and id != {$_SESSION['user_id']} " : ''))->num_rows;
		if($check > 0){
			return 2;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO clients set $data");
		}else{
			$save = $this->db->query("UPDATE clients set $data where id ={$_SESSION['user_id']}");
		}

		if($save){
			foreach ($_POST as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			return 1;
		}
	}


function save_loan(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		
		if(empty($id)){
		
		$save = $this->db->query("INSERT INTO loan_list set $data");

		}else{
		
	   $save = $this->db->query("UPDATE loan_list set $data where id = $id");
	
		}

	if ($save) {
    return 1;
}

		
}

}