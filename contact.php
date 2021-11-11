
<?php 

    require 'includes/app.php';
    includeTemplate('header');
?>

<main class="wrap-contact d-flex flex-column">

    <section class="wrap-for">
        <h2 class="title-contact text-center m-4">CONTACTO</h2>
        <p class="subtitle-contact text-center">El tiempo de respuesta es aproximadamente de 1 a 2 horas</p>
        <form action="" method="POST" class="form-contact d-flex flex-column align-items-center">
            <input class="w-50" type="text" name="name" id="name" placeholder="Escribe tu nombre..." required />
            <input class="w-50"  type="email" name="email" id="email" placeholder="Escribe tu correo..." required>
            <textarea class="w-50" name="msg" placeholder="Escribe tu mensaje" required></textarea>
            <label class="w-50 pol " for="polict"><input class="p-2" type="checkbox" name="polict" id="polict" value="Si" required>Con anterioridad a la remisión de mis datos, he leído la advertencia y la Política de Privacidad incluida en esta página Web, y me muestro expresamente de acuerdo con sus términos.</label>
        </form>
    </section>
    

</main>

<?php includeTemplate('footer')?>