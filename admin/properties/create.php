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
    $nameImage = md5(uniqid(rand(), true));
    $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
    $completeImg = $nameImage . "." . $extension;


    if ($_FILES['image']['tmp_name']) {
        $image = Image::make($_FILES['image']['tmp_name'])->fit(800, 600); //name and 
        $serviceInstace->setImage($completeImg);
    }
    $errors = $serviceInstace->validateData();



    if (empty($errors)) {

        if (!is_dir(FOLDER_IMG)) {
            mkdir(FOLDER_IMG);
        }

        //upload img
        $image->save(FOLDER_IMG . $completeImg);

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