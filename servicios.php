<?php 

    require 'includes/app.php';


    $db = connectDB();

    //Show all services
    $query = "SELECT id, name, imageProduct FROM services ORDER BY id DESC";
    $data = mysqli_query($db, $query);


    includeTemplate('header');
?>


<main class="wrap">

    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="build/img/xbanner-services-2.webp" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="build/img/xbanner-services-3.webp" alt="Third slide">
        </div>
    </div>
    </div>
    <section class="services-box d-flex flex-column">

    <!-- se rellena de services-->
    <h2 class="text-info m-4 text-center text-uppercase">Servicios</h2>
        <div class="content-box d-flex flex-wrap m-4 justify-content-center">

            <?php while ( $service = mysqli_fetch_assoc($data) ): ?>

                <div class="service-box m-4">
                    <a class="m-2" href="service.php?id=<?php echo $service['id'] ?>"><img src="admin/img/<?php echo $service['imageProduct'] ?>" class="img-products" alt="Plan Desarrollo web" ></a>
                    <a href="service.php?id=<?php echo $service['id'] ?>" class="m-2 title-services-box text-success"> <?php echo $service['name']?> </a>

                    <!-- TABLA PIVOTE -->
                    <?php
                    $queryToServices = "SELECT name FROM service WHERE serviceID = ${service['id']}";
                    $dataToServices = mysqli_query($db,$queryToServices);
                    ?>

                    <?php while ( $services = mysqli_fetch_assoc($dataToServices) ): ?>
                        <p class="mt-2 ml-4"> <?php echo $services['name'] ?> </p>
                    <?php endwhile; ?>

                </div>
            <?php endwhile; ?>
                
        </div>
    </section>
    <hr>
    <section class="what-help align-self-center justify-content-center">
        <div id="carouselExampleSlidesOnly" class="carousel slide w-50 m-2" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="build/img/menu4.webp" alt="proyecto tucodigofavorito.com">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="build/img/padron_v02.webp" alt="Proyecto Policia">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="build/img/tucodigo.webp" alt="Tmenu4fitness">
                </div>
            </div>
        </div>
        <div class="content-carousel m-4">
            <h3 class="text-success">¿Qué podemos hacer por ti?</h3>
            <span>Mejorar tu presencia en Internet</span>
            <p>Haremos tu marca visible en Internet, ubicamos tu empresa en el mapa de Google y daremos a tu marca la presencia online que necesita adaptándonos a cada circunstancia.</p>
            <br/>        

            <span>Cuidar tu reputación online</span>
            <p>Cuidamos la reputación de tu marca en Internet, atenderemos las dudas y problemas que tengan los clientes y resolveremos cualquier conflicto que se pueda generar de una manera cercana y personal.</p>
            <br/>        
    
            <span>Presupuestos a medida</span>
            <p>Cada cliente es diferente y necesita un servicio personalizado con las necesidades de su proyecto, explícanos el tuyo y te daremos respuesta a la mayor brevedad.</p>
        </div>
    </section>
</main>

<?php includeTemplate('footer') ?>