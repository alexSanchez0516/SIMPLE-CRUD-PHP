<?php

require '../../includes/funciones.php';
require '../../includes/config/db.php';

$db = connectDB();
isAuth();



$id = filter_var(intval($_GET['updateID']), FILTER_VALIDATE_INT) ? : header('Location: /');



$query = "SELECT * FROM services WHERE id = ${id}";
$result = mysqli_query($db, $query);

$data = mysqli_fetch_assoc($result);



//update

$title = $data['name'];
$description = $data['description'];
$price = $data['price'];
$errors_file = [];


if (empty($errors_file)) {
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
        <fieldset class="wrap-form-admin d-flex flex-column m-2">
            <legend>Información General</legend>

            <label for="title">Title</label>
            <input type="text" name="title" id="title_admin_create" value="<?php echo $title ?>">

            <label for="description">Description</label>
            <input type="text" name="description" id="description_admin_create" value="<?php echo $description ?>" />

            <label for="services">Services</label>
            <textarea name="services" id="" cols="30" rows="10"></textarea>


            <label for="price">Price</label>
            <input type="number" name="price" id="price" value="<?php echo $price ?>" />

            <label for="image"></label>
            <input type="file" id="image" accept="image/jpeg, image/png, image/webp" value="hola">

            <input type="submit" value="Update" class="w-25 mt-2">


        </fieldset>
    </form>

</main>

<?php includeTemplate('footer') ?>