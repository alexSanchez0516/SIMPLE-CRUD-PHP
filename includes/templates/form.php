<fieldset class="wrap-form-admin d-flex flex-column m-2">
    <legend class="text-secondary">Información General</legend>

    <label class="text-secondary" for="title">Title</label>
    <input class="validation" minlength=3 type="text" name="name" id="title_admin_create" placeholder="Titulo" required value="<?php echo s( $serviceInstace->name); ?>" />

    <label class="text-secondary" for="description">Description</label>
    <textarea minlength=3 class="validation" name="description" cols="30" rows="10" id="description_admin_create" placeholder="Description" required value="<?php echo s( $serviceInstace->description ); ?>"></textarea>

    <label class="text-secondary" for="services">Add Services</label>
    <textarea name="services" minlength=3 id="" class="validation" cols="30" rows="10" required></textarea>

    <label class="text-secondary" for="price">Price</label>
    <input type="number" minlength=1 class="validation" name="price"  id="price" required value="<?php echo s( $serviceInstace->price ); ?>" />

    <label class="text-secondary" for="image"></label>
    <input type="file" id="image" name="image" accept="image/jpeg, image/png, image/webp">


</fieldset>