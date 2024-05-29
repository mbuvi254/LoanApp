<?php
session_start();
ini_set('display_errors', 1);

Class Action {
    private $db;

    public function __construct() {
        ob_start();
        include './library/dbh.php';
        $this->db = $conn;
    }

    function __destruct() {
        $this->db->close();
        ob_end_flush();
    }

    function login() {
        extract($_POST);
        $qry = $this->db->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM admin where email = '".$email."' and password = '".md5($password)."' ");
        if ($qry->num_rows > 0) {
            foreach ($qry->fetch_array() as $key => $value) {
                if ($key != 'password' && !is_numeric($key))
                    $_SESSION['admin_'.$key] = $value;
            }
            $uip = $_SERVER['REMOTE_ADDR'];
            $log = $this->db->query("INSERT INTO adminlog (admin,ip) VALUES('$email','$uip')");
            return 1;
        } else {
            return 3;
        }
    }

    function logout() {
        session_destroy();
        foreach ($_SESSION as $key => $value) {
            date_default_timezone_set('Africa/Nairobi');
            $ldate = date("Y-m-d H:i:s");
            $log = $this->db->query("UPDATE adminlog  SET logout = '$ldate' WHERE admin = '".$_SESSION['admin_email']."' ORDER BY id DESC LIMIT 1");
            unset($_SESSION[$key]);
        }
        header("location:login.php");
    }

    function save_loan_type() {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('id')) && !is_numeric($k)) {
                if (empty($data)) {
                    $data .= " $k='$v' ";
                } else {
                    $data .= ", $k='$v' ";
                }
            }
        }
        if (empty($id)) {
            $save = $this->db->query("INSERT INTO loan_types set $data");
        } else {
            $save = $this->db->query("UPDATE loan_types set $data where id = $id");
        }

        if ($save)
            return 1;
    }

    function delete_loan_type() {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM loan_types where id = ".$id);
        if ($delete) {
            return 1;
        }
    }

    function save_loan_plan() {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('id')) && !is_numeric($k)) {
                if (empty($data)) {
                    $data .= " $k='$v' ";
                } else {
                    $data .= ", $k='$v' ";
                }
            }
        }
        if (empty($id)) {
            $save = $this->db->query("INSERT INTO loan_plan set $data");
        } else {
            $save = $this->db->query("UPDATE loan_plan set $data where id = $id");
        }

        if ($save)
            return 1;
    }

    function delete_loan_plan() {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM loan_plan where id = ".$id);
        if ($delete) {
            return 1;
        }
    }

 
  function save_loan() {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('id')) && !is_numeric($k)) {
                if (empty($data)) {
                    $data .= " $k='$v' ";
                } else {
                    $data .= ", $k='$v' ";
                }
            }
        }

        if (empty($id)) {
            $save = $this->db->query("INSERT INTO loan_list set $data");
        } else {
            $save = $this->db->query("UPDATE loan_list set $data where id = $id");
        }

        if ($save)
            return 1;
    }

    function delete_loan() {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM loan_list where id = ".$id);
        if ($delete) {
            return 1;
        }
    }




    function save_payment() {
        extract($_POST);
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('id')) && !is_numeric($k)) {
                if (empty($data)) {
                    $data .= " $k='$v' ";
                } else {
                    $data .= ", $k='$v' ";
                }
            }
        }

        if (empty($id)) {
            $save = $this->db->query("INSERT INTO payments set $data");
        } else {
            $save = $this->db->query("UPDATE payments set $data where id = $id");
        }

        if ($save)
            return 1;
    }

    function delete_payment() {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM payments where id = ".$id);
        if ($delete) {
            return 1;
        }
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
            exit;
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

       function delete_client() {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM clients where id = ".$id);
        if ($delete) {
            return 1;
        }
    }

function save_admin(){
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
        $check = $this->db->query("SELECT * FROM admin where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
        if($check > 0){
            return 2;
            exit;
        }
        if(empty($id)){
            $save = $this->db->query("INSERT INTO admin set $data");
        }else{
            $save = $this->db->query("UPDATE admin set $data where id = $id");
        }

        if($save){
            return 1;
        }
    }

    function delete_admin(){
        extract($_POST);
        $delete = $this->db->query("DELETE FROM admin where id = ".$id);
        if($delete)
            return 1;
    }











}
?>
