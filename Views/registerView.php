<main class="d-flex align-items-center justify-content-center height-100">
    <div class="content">
        <header class="text-center">
            <h2 style="color: #4e555b">Registrarse</h2>
        </header>
        <form action="<?php echo FRONT_ROOT ?> User/Add" method="post" class="login-form bg-dark-alpha p-5 text-white">
            <header class="text-center">
                <h2 style="color: #4e555b">Crear una cuenta</h2>
            </header>
            <div class="form-group">
                <label style="color: #4e555b" for="name">Nombre</label>
                <input type="text" id="name" name="userName" value="" class="form-control form-control-lg" placeholder="Ingresar nombre" required>
            </div>
            <div class="form-group">
                <label style="color: #4e555b" for="lastName">Apellido</label>
                <input type="text" id="lastName" name="lastName" value="" class="form-control form-control-lg" placeholder="Ingresar apellido" required>
            </div>
            <div class="form-group">
                <label style="color: #4e555b" for="email">Email</label>
                <input type="email" id="email" name="email" value="" class="form-control form-control-lg" placeholder="Ingresar email" required>
            </div>
            <div class="form-group">
                <label style="color: #4e555b" for="password">Contraseña</label>
                <input type="password" id="password" name="password" value="" class="form-control form-control-lg" placeholder="Ingresar contraseña" required>
            </div>
            <div class="form-group">
                <button class="btn btn-dark btn-block btn-lg" type="submit" name="button" class="">Registrarse</button>
            </div>
        </form>
        <div>
            <a href="<?php echo FRONT_ROOT ?>User/ShowLoginView"><button class="btn btn-dark btn-block btn-lg">Cancelar</button></a>
        </div>
            <?php  if(isset($message)){ echo "<script> alert('$message'); </script>"; }
            ?>
    </div>
</main>

