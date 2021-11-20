<?php

use App\Services;
use Intervention\Image\ImageManagerStatic as Image;


require '../../includes/app.php';


$db = connectDB();
isAuth();



$id = filter_var( intval($_GET['updateID']), FILTER_VALIDATE_INT) ?: header('Location: /');

$errors = Services::getErrors();
$serviceInstace = Services::find($id);
$imgDelete = $serviceInstace->imageProduct;


$args = [];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    ob_start();
    $args = [];

    $args['name'] = $_POST['name'] ?? null;
    $args['description'] = $_POST['description'] ?? null;
    $args['services'] = $_POST['services'] ?? null;
    $args['price'] = $_POST['price'] ?? null;
    $args['imageProduct'] = $_FILES['image']['name'] ?? null;

    $serviceInstace->synchronize($args);

    $errors = $serviceInstace->validateData();


    if (empty($errors)) {
        if (!empty($_FILES['image']['tmp_name'])) {
            $serviceInstace->uploadImg($_FILES['image'], $imgDelete);
        }
        $serviceInstace->save();
        
    }

}





includeTemplate('header');
?>

<main class="wrap">
    <button onclick="window.location.href='../' " type="button" class="btn btn-outline-info text-dark w-25 m-4" id="btn-return-create">Return</button>
    <h1 class="text-admin text-primary text-center m-4">Actualizar Servicio</h1>

    <?php foreach ($errors as $e) : ?>
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