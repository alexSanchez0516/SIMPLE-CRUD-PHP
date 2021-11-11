<?php

require '../includes/funciones.php';
require '../includes/config/db.php';


isAuth();

$db = connectDB();


//Delete
if(isset($_GET["deleteID"])) {

    $idDelete = filter_var(intval($_GET['deleteID']), FILTER_VALIDATE_INT ? : header('Location: /'));
    
    //Name photo 
    $query = "SELECT imageProduct FROM services WHERE id = ${idDelete}";
    $data = mysqli_query($db, $query);
    $img = mysqli_fetch_assoc($data);


    file_exists('img/'. $img["imageProduct"]) ? unlink('img/'. $img["imageProduct"]) : false ;

    $query = "DELETE FROM service WHERE serviceID =${idDelete}";
    $data = mysqli_query($db, $query);

    $query = "DELETE FROM services WHERE id = ${idDelete}";
    $data = mysqli_query($db, $query);
}




/*MOSTRAR TODOS LOS SERVICIOS */
$query = "SELECT * FROM services";
$data = mysqli_query($db, $query);
$message = $_GET['create'] ?? null; //inset si no existe es valor null


includeTemplate('header');


?>

<main class="wrap">

    <?php if (intval($message) === 1): ?>
        <p class="text-success text-center display-6 m-2">
            Servicio creado correctamente
        </p>
    <?php elseif(intval($message) === 2): ?>
        <p class="text-success text-center display-6 m-2">
            Servicio actualizado correctamente
        </p>
    <?php endif; ?>
    
    <h1 class="text-admin text-center text-primary m-4">Administrador de Servicios</h1>
    <a href="/admin/properties/create.php" id="addService" class=" btn btn-outline-info" >CREATE SERVICE</a>
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
            <?php while ( $service = mysqli_fetch_assoc($data) ): ?>
            <tr>
                <th scope="row"><?php echo $service['id'] ?></th> <!-- ID -->
                <td><?php echo $service['name'] ?></td>
                <td><?php echo $service['description'] ?></td>
                <td><?php echo $service['price'] ?>€</td>
                
                <td> <img src="/admin/img/<?php echo $service['imageProduct']?>" class="img-fluid" style="height:45px;" ></td>


                <td class="bg-danger btn-table"><a href="/admin/?deleteID=<?php echo $service['id']?>">DELETE</a></td>
                <td class="bg-danger btn-table"><a href="/admin/properties/update.php?updateID=<?php echo $service['id'] ?>">UPDATE</a></td>

            </tr>
            <?php endwhile;  ?>

        </tbody>
    </table>

</main>

<?php 

mysqli_close($db);
includeTemplate('footer');
 ?>