<?php
$showError = "false";
if($_SERVER['REQUEST_METHOD'] == "POST"){
include "dbconnect.php";
$email = $_POST['loginEmail'];
$password = $_POST['loginPassword'];
$sql = "SELECT * FROM `users` where user_email = '$email'";
$result = mysqli_query($conn, $sql);
$numRows = mysqli_num_rows($result);
if($numRows == 1){
    $row = mysqli_fetch_assoc($result);
    if(password_verify($password, $row['user_password'])){
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['useremail'] = $email;
    echo "Logged in .$email";
}
    header("location: /php/forum/index.php");
    
}
header("location: /php/forum/index.php");
}

?>