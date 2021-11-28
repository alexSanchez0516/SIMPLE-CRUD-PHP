<?php

use App\Users;

require 'includes/app.php';

$db = connectDB();

$errors = [];

$user_login = new Users();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_login = new Users($_POST);
    $user_login->login();
    $errors[] = $user_login->getErrors();
        
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/src/img/Favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="build/css/app.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Divisione</title>
</head>

<body>
    <main class="login-wrap">

        <section class="left d-flex flex-column w-50">
            <img src="build/img/Divisione.webp" id="img-login" alt="Logotipo">
            <h1 class="text-info text-decoration-underline mb-4">Divisione.es</h1>

            <?php foreach (array_shift($errors) as $error): ?>
                <div class="errors mb-2">
                    <?php echo $error ?>
                </div>
            <?php endforeach; ?>
                
            <form method="POST" id="form-login">
                <legend class="text-center text-info" id="legend-login">Control de Acceso</legend>
                <input type="text" name="username" id="user" placeholder="Usuario" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <input type="submit" class="btn btn-primary" value="Ingresar">
            </form>
        </section>

        <img src="build/img/photologin.webp" class="w-50" id="img-banner" alt="Banner">

    </main>
</body>

</html>