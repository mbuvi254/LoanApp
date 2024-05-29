<?php
session_start();
include('lib/dbh.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function check_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $firstname = check_input($_POST['firstname']);
    $middlename = check_input($_POST['middlename']);
    $lastname = check_input($_POST['lastname']);
    $contact = check_input($_POST['contact']);
    $email = check_input($_POST['email']);
    $password=md5(check_input($_POST['password']));


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['sign_msg'] = "Invalid email format";
        header('location:signup.php');
    } else {
        // Using prepared statements to prevent SQL injection
        $query = $conn->prepare("SELECT * FROM clients WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['sign_msg'] = "Email already taken";
            header('location:signup.php');
        } else {
            $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $code = substr(str_shuffle($set), 0, 12);

            // Using prepared statements for insertion
            $insertQuery = $conn->prepare("INSERT INTO clients (firstname, lastname, middlename, contact, email, password, code) VALUES (?, ?, ?, ?, ?, ?,?)");
            $insertQuery->bind_param("sssssss", $firstname, $lastname, $middlename, $contact, $email, $password, $code);
            $insertQuery->execute();
            $uid = $insertQuery->insert_id;
            
            // Sending email verification
            $to = $email;
            $subject = "cybermaisha Verification Code";
            $message = "<html><head><title>Cybermaisha Account Verification</title></head><body><h2>Thank you for Registering.</h2><p>Your Account Login Details:</p><p>Email: ".$email."</p><p>Password: ".$_POST['password']."</p><p>Please click the link below to activate your account.</p><h4><a href='https://www.chama.cybermaisha.co.ke/activate.php?uid=$uid&code=$code'>Activate My Account</h4></body></html>";

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: admin@cybermaisha.co.ke". "\r\n" . "CC:accounts@cybermaisha.co.ke";

            mail($to, $subject, $message, $headers);

            $_SESSION['sign_msg'] = "Verification code sent to your email.";
            header('location:signup.php');
        }
    }
}
?>
