<?php 

    require 'includes/app.php';


    $db = connectDB();
    use App\Services;


    $data = Services::consulSQL("SELECT services.id, name, imageProduct, description, service.nameService FROM services LEFT JOIN service ON services.id = service.serviceID; ");
    $listServies = [];

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

            <?php foreach ($data as $date): ?>

                <div class="service-box m-4">
                    <a class="m-2" href="service.php?id=<?php echo $date->id ?>"><img src="admin/img/<?php echo $date->imageProduct ?>" class="img-products" alt="Plan Desarrollo web" ></a>
                    <a href="service.php?id=<?php echo $date->id ?>" class="m-2 title-services-box text-success"> <?php echo $date->name ?> </a>                  
                   
                    <?php 
                    $listServies = explode(",",$date->nameService);
                    ?>

                    <?php foreach($listServies as $service):?>
                        <p class="mt-2 ml-4"> <?php echo $service ?> </p>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
                
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