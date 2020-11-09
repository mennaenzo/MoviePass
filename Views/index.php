<?php
///require_once('nav.php');
if(isset($message)){
    if($message != null){
        echo "<script> alert('$message'); </script>";
    }
}

?>
<!--
<main class="">
    <section id="" class="">
        <div class="">
            <h2 class="" style="color: #4e555b">LOGIN</h2>
            <form action="<?php //echo FRONT_ROOT ?>User/Login" method="post" class="">
                <div class="">
                    <div class="">
                        <div class="">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="" class="" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="">
                        <div class="">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" value="" class="" placeholder="Password" required>
                        </div>
                    </div>

                </div>
                <button type="submit" name="button" class="">Log</button>
            </form>
        </div>
        <br>
        <div>
            <a href="<?php// echo FRONT_ROOT ?>User/ShowRegisterView"><button>Register</button></a>
        </div>
    </section>
-->
  <main class="d-flex align-items-center justify-content-center height-100">
          <div class="content">
               <form action="<?php echo FRONT_ROOT ?>User/Login" method="post" class="login-form bg-dark-alpha p-5 text-white">
                   <header class="text-center">
                       <h2 style="color: #4e555b">Iniciar Sesión</h2>
                   </header>
                    <div class="form-group">
                         <label style="color: #4e555b" for="">Email</label>
                         <input type="email" name="email" class="form-control form-control-lg" placeholder="Ingresar email" required>
                    </div>
                    <div class="form-group">
                         <label style="color: #4e555b" for="">Contraseña</label>
                         <input type="password" name="password" class="form-control form-control-lg" placeholder="Ingresar constraseña" required>
                    </div>
                    <div class="form-group">
                    <button class="btn btn-dark btn-block btn-lg" type="submit">Iniciar Sesión</button>
                    </div>
               </form>
              <div class="form-group">
                  <a href="<?php echo FRONT_ROOT ?>User/ShowRegisterView"><button class="btn btn-dark btn-block btn-lg">Registrarse</button></a>
              </div>
          </div>
  </main>

