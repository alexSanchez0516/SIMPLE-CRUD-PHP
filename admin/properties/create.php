<?php
require '../../includes/app.php';
require 'errors.php';


use App\Services;



$db = connectDB();


isAuth();


includeTemplate('header');

$title = "";
$description = "";
$price = "";

$errors_file = [];


if (empty($errors_file)) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        /*
        La función ob_start() sirve para indicarle a PHP que se ha de
        iniciar el buffering de la salida, es decir, que debe empezar
        a guardar la salida en un bufer interno, en vez de enviarla
        al cliente.
        */ 
        ob_start();



        $folderImg = "../img/";

        if (!is_dir($folderImg)) {
            mkdir($folderImg);
        }

        //Generate name for image
        $image = $_FILES['image'];
        $nameImage = md5(uniqid(rand(), true));
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);

        move_uploaded_file($image['tmp_name'], $folderImg . $nameImage . "." . $extension);

        $completeImg = $nameImage . "." . $extension;


        if (!$image['name']) {
            $errors_file = ["DEBES SUBIR UNA FOTO"];
        } else {
            //debug($_POST);
            $serviceInstace = new Services($_POST); 
            exit;
            $serviceInstace->save();
        }
    }
}



?>

<main class="wrap">
    <button onclick="window.location.href='../' " type="button" class="btn btn-outline-info text-dark w-25 m-4" id="btn-return-create">Return</button>
    <h1 class="text-admin text-primary text-center m-4">Crear Servicio</h1>

    <?php foreach ($errors_file as $e) : ?>
        <div class="errors">
            <?php echo $e ?>
        </div>
    <?php endforeach; ?>

    <form action="/admin/properties/create.php" method="POST" id="form-admin" class="d-flex flex-column" enctype="multipart/form-data">
        <!-- PARA SUBIR IMAGES -->
        <fieldset class="wrap-form-admin d-flex flex-column m-2">
            <legend class="text-secondary">Información General</legend>

            <label class="text-secondary" for="title">Title</label>
            <input class="validation" minlength=3 type="text" name="title" id="title_admin_create" required value="<?php echo $title ?>" />

            <label class="text-secondary" for="description">Description</label>
            <input type="text" minlength=3 class="validation" name="description" id="description_admin_create" required value="<?php echo $description ?>" />

            <label class="text-secondary" for="services">Add Services</label>
            <textarea name="services" minlength=3 id="" class="validation" cols="30" rows="10" required></textarea>

            <label class="text-secondary" for="price">Price</label>
            <input type="number" minlength=3 class="validation" name="price" id="price" required value="<?php echo $price ?>" />

            <label class="text-secondary" for="image"></label>
            <input type="file" id="image" name="image" accept="image/jpeg, image/png, image/webp">

            <input type="submit" value="Crete" id="send" class=" w-25 mt-2">

        </fieldset>
    </form>

</main>

<?php includeTemplate('footer') ?>