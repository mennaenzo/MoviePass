<?php
    require_once VIEWS_PATH . "nav.php";
?>
<main class="">
     <section id="listado" class="mb-5">
              <form style="" id= "cineAdd" action="<?php echo FRONT_ROOT ?>Cinema/Add" method="post" class="bg-light-alpha p-5">
                  <header class="header">
                      <br>
                      <br>
                      <h2 style="color: black"><strong>Agregar Cine</strong></h2>
                  </header>
                  <div class="sep">
                         <div class="inputs">

                            <label style="color: black" for="name"><strong>Nombre</strong></label>
                            <input type="text" name="cinema_name" value="" class="form-control" required>

                            <label style="color: black" for="address"><strong>Direccion</strong></label>
                            <input type="text" name="cinema_address" value="" class="form-control" required>
                            <br>
                            <button id="submit" type="submit" name="button" value ="" class="btn btn-dark ml-auto d-block">Agregar Cine</button>
                         </div>
                         <?php
                            if (isset($message)) {
                                echo "<script> alert('$message'); </script>";
                            }
                        ?>
                  </div>
              </form>
     </section>
</main>