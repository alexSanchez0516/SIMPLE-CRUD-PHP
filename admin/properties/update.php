<?php

use App\Services;

require '../../includes/app.php';


$db = connectDB();
isAuth();



$id = filter_var(intval($_GET['updateID']), FILTER_VALIDATE_INT) ? : header('Location: /');

$errors_file = [];
$serviceInstace = Services::find($id);
 




    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        ob_start();

        

        //Escapa de sql injection 
        $title = mysqli_real_escape_string($db,  $_POST['title']);
        $description = mysqli_real_escape_string($db, $_POST['description']);
        $price = mysqli_real_escape_string($db, $_POST['price']);

        $query = " UPDATE services SET name = '${title}', description = '${description}', price = ${price} WHERE id = ${id} ";


        //Mandar a 404
        $result = mysqli_query($db, $query) ? header("Location: /admin") : header('Location: /build/404.php');


    }





includeTemplate('header');
?>

<main class="wrap">
    <button onclick="window.location.href='../' " type="button" class="btn btn-outline-info text-dark w-25 m-4" id="btn-return-create">Return</button>
    <h1 class="text-admin text-primary text-center m-4">Actualizar Servicio</h1>

    <?php foreach ($errors_file as $e) : ?>
        <div class="errors">
            <?php echo $e ?>
        </div>
    <?php endforeach; ?>


    <form action="" method="POST" id="form-admin" class="d-flex flex-column" enctype="multipart/form-data">
        <?php include '../../includes/templates/form.php' ?>
        <input type="submit" value="Update" class="w-25 mt-2">
    </form>

</main>

<?php includeTemplate('footer') ?>