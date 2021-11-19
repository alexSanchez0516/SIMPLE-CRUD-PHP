<?php

require '../includes/app.php';


isAuth();

$db = connectDB();

use App\Services;

$services = Services::all();


//Delete
if (isset($_GET["deleteID"])) {

    $idDelete = filter_var(intval($_GET['deleteID']), FILTER_VALIDATE_INT) ?: header('Location: /?chistoso');
    $ServiceInstance = Services::find($idDelete);
    $ServiceInstance->delete();

    exit;
    //Name photo 
    $query = "SELECT imageProduct FROM services WHERE id = ${idDelete}";
    $data = mysqli_query($db, $query);
    $img = mysqli_fetch_assoc($data);


    file_exists('img/' . $img["imageProduct"]) ? unlink('img/' . $img["imageProduct"]) : false;

    $query = "DELETE FROM service WHERE serviceID =${idDelete}";
    $data = mysqli_query($db, $query);

    $query = "DELETE FROM services WHERE id = ${idDelete}";
    $data = mysqli_query($db, $query);
}




/*MOSTRAR TODOS LOS SERVICIOS */
$query = "SELECT * FROM services";
$data = mysqli_query($db, $query);

$state = null;
if (isset($_GET['state'])) {
    $state = filter_var($_GET['state'], FILTER_VALIDATE_INT) ?? null; //inset si no existe es valor null
}

includeTemplate('header');


?>

<main class="wrap">

    <?php if (intval($state) === 1) : ?>
        <p class="text-success state text-center h4 m-2">
            Servicio creado correctamente
        </p>
    <?php elseif (intval($state) === 2) : ?>
        <p class="text-success state text-center h4 m-2">
            Servicio actualizado correctamente
        </p>
    <?php elseif (intval($state) === 3) : ?>
        <p class="text-success state text-center h4 m-2">
            Servicio eliminado correctamente
        </p>
    <?php endif; ?>

    <h1 class="text-admin text-center text-primary m-4">Administrador de Servicios</h1>
    <a href="/admin/properties/create.php" id="addService" class=" btn btn-outline-info">CREATE SERVICE</a>
    <table class="table  table-responsive table-hover table-dark  admin-table ">
        <thead>
            <tr>
                <!--CAMPOS -->
                <th scope="col">ID</th>
                <th scope="col">NAME</th>
                <th scope="col">DESCRIPTION</th>
                <th scope="col">PRICE</th>
                <th scope="col">PHOTO</th>

                <th scope="col" class="text-center  text-danger" colspan="2">OPTIONS</th>


            </tr>
        </thead>

        <tbody>
            <?php foreach ($services as $service) : ?>
                <tr>
                    <th scope="row"><?php echo $service->id; ?></th> <!-- ID -->
                    <td><?php echo $service->name; ?></td>
                    <td><?php echo $service->description; ?></td>
                    <td><?php echo $service->price; ?>€</td>

                    <td> <img src="/admin/img/<?php echo $service->imageProduct; ?>" class="img-fluid" style="height:45px;"></td>


                    <td class="bg-danger btn-table"><a href="/admin/?deleteID=<?php echo $service->id; ?>">DELETE</a></td>
                    <td class="bg-danger btn-table"><a href="/admin/properties/update.php?updateID=<?php echo $service->id; ?>">UPDATE</a></td>

                </tr>
            <?php endforeach;  ?>

        </tbody>
    </table>

</main>

<?php

mysqli_close($db);
includeTemplate('footer');
?>