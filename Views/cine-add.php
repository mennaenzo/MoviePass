<?php
    require_once VIEWS_PATH . "nav.php";
?>
<main class="py-auto">
     <section id="listado" class="mb-5">
              <form id= "cineAdd" action="<?php echo FRONT_ROOT ?>Cinema/Add" method="post" class="bg-light-alpha p-5">
                  <header class="header">
                      <br>
                      <br>
                      <h2>Agregar Cinema</h2>
                  </header>
                  <div class="sep"></div>
                         <div class="inputs">

                            <label for="name">Name</label>
                            <input type="text" name="cinema_name" value="" class="form-control" required>

                            <label for="address">Address</label>
                            <input type="text" name="cinema_address" value="" class="form-control" required>
                            <br>
                            <button id="submit" type="submit" name="button" value ="" class="btn btn-dark ml-auto d-block">Add Room</button>
                         </div>
                         <?php
                            if (isset($message)) {
                                echo "<script> alert('$message'); </script>";
                            }
                        ?> 
              </form>
          </div>
     </section>
</main>