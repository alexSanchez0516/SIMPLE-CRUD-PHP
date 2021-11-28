<?php 
    require 'includes/app.php';
    includeTemplate('header');

    use App\Services;


    if (empty($_GET)) {
        header('Location: /');
        exit;
    } else {
        $db = connectDB(); 
        $id = filter_var(intval($_GET['id']), FILTER_VALIDATE_INT);

        $query = "SELECT * FROM";
        $query .= " services LEFT JOIN service ON service.serviceID = services.id WHERE services.id = $id ";
        $service = Services::consulSQL($query);
        $service = array_shift($service);
        $listServices = explode(",", $service->nameService);
 
    }

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


        <section class="service-box-wrap">
            

            <h2 class="title-box-wrap text-center m-4">
                <?php echo $service->name ?>
            </h2>

            <p class="sumary-box-product-wrap">
                <?php echo $service->description ?>
            </p>

            <ul class="list-product-wrap">
                <h3 class="text-primary m-4 h5 ">¿QUÉ SOMOS CAPACES DE HACER?</h3>

               
                <?php foreach ($listServices as $service): ?>
               
                    <li class="m-2"><?php echo $service ?></li>

                <?php endforeach; ?>

            </ul>

        </section>

        <section class="contact-foot">
                <h3 class="title-contact-foot title-deluxe text-center m-4 text-light">Obtenga un presupuesto gratuito</h3>
                <form action="includes/php/contact.php" method="post" class="form-contact-foot d-flex flex-column">
                    <div class="content-contact-foot">
                        <input type="text" name="name" id="name" placeholder="Nombre"  required>
                        <input type="email" name="email" id="email" placeholder="Correo electrónico" required>
                        <input type="text" name="company" id="company" placeholder="Compañia" required>
                        <input type="text" name="url" id="url" placeholder="URL del sitio web" required>
                    </div>
                    <input type="text" name="content" id="content" required placeholder="¿Qué contenido principal necesitas en tu proyecto?">
                </form>
                <textarea class="text-area-contact" name="details" id="details" cols="40" rows="6" required placeholder="Proporcione cualquier otro detalle o pregunta que tenga sobre su sitio web"></textarea>
                <button type="button" class="btn btn-outline-light w-25 m-4">Enviar</button>
            </section>


    </main>

<?php require 'includes/templates/footer.php' ?>



