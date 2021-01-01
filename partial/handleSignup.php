<?php
$showError = "false";
// $showAlert = false;
if($_SERVER['REQUEST_METHOD'] == "POST"){
     include "dbconnect.php"; 
     $user_email = $_POST['signupEmail'];
     $user_password = $_POST['signPassword'];
     $user_cpassword = $_POST['signcPassword'];
    //  check wheather user email exists or not
     $existsql = "SELECT * FROM `users` where user_email = '$user_email'";
     $result = mysqli_query($conn, $existsql);
     $numRows = mysqli_num_rows($result);
     if($numRows>0){
         $showError = "Email is already in use";
     }
     else{
         if($user_password == $user_cpassword){
            $hash = password_hash($user_password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_password`, `dateTime`) 
            VALUES ('$user_email', '$hash', current_timestamp());";
            $result = mysqli_query($conn, $sql);
            if($result){
                // $showAlert = true;
                header("location: /php/forum/index.php?signupsuccess=true");
                exit();
            }
         }
         else{
             $showError = "Passwords do not match";
             
         }
     }
     header("location: /php/forum/index.php?signupsuccess=false&error = $showError");
 }
?>