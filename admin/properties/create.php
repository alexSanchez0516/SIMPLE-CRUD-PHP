<?php
require '../../includes/app.php';
require 'errors.php';


use App\Services;

use Intervention\Image\ImageManagerStatic as Image;

$db = connectDB(); 
isAuth();


includeTemplate('header');
$serviceInstace = new Services();
$errors = Services::getErrors();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    ob_start();

    $serviceInstace = new Services($_POST);

    $image = $_FILES['image'];
    $serviceInstace->uploadImg($image, null);

    $errors = $serviceInstace->validateData();

    if (empty($errors)) {

        $serviceInstace->save();

    }
}




?>

<main class="wrap">
    <button onclick="window.location.href='../' " type="button" class="btn btn-outline-info text-dark w-25 m-4" id="btn-return-create">Return</button>
    <h1 class="text-admin text-primary text-center m-4">Crear Servicio</h1>

    <?php foreach ($errors as $e) : ?>
        <div class="errors">
            <?php echo $e ?>
        </div>
    <?php endforeach; ?>

    <form action="/admin/properties/create.php" method="POST" id="form-admin" class="d-flex flex-column" enctype="multipart/form-data">
        <!-- PARA SUBIR IMAGES -->
        <?php include '../../includes/templates/form.php' ?>
        <input type="submit" value="Crete" id="send" class=" w-25 mt-2">

    </form>

</main>

<?php includeTemplate('footer') ?>