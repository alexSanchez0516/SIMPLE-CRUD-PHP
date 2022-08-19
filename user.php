<?php 
    require 'includes/config/db.php';

    $db = connectDB();

    $user = 'admin';
    $password = ".";
    $email = "";

    $password_hash = password_hash($password, PASSWORD_BCRYPT);


    $query = "INSERT INTO users (username, password, email) VALUES ('$user', '$password_hash', '$email')";
    exit;
    $data = mysqli_query($db, $query);


?>
