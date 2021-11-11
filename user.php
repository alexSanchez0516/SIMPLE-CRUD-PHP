<?php 
    require 'includes/config/db.php';

    $db = connectDB();

    $user = 'admin';
    $password = "1690001299Gr.";
    $email = "alexandervillegas0516@gmail.com";

    $password_hash = password_hash($password, PASSWORD_BCRYPT);


    $query = "INSERT INTO users (username, password, email) VALUES ('$user', '$password_hash', '$email')";
    exit;
    $data = mysqli_query($db, $query);


?>