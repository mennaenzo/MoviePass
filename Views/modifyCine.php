<?php
    require_once VIEWS_PATH . "nav.php";
?>
<main class="py-auto">
     <section id="listado" class="mb-5">
              <form id= "modifyForm" action="<?php echo FRONT_ROOT ?>Cinema/modify" method="post" class="bg-light-alpha p-5">
                  <header class="header">
                      <br>
                      <br>
                      <h2 style="color: black" >Modificar cine</h2>
                  </header>
                  <div class="sep"></div>
                         <div class="inputs">

                            <label style="color: black" for="name">Name</label>
                            <input type="text" name="name" value="<?php echo $cinema->getName();?>" class="form-control" required>

                            <label style="color: black" for="address">Address</label>
                            <input type="text" name="address" value="<?php echo $cinema->getAddress()?>" class="form-control" required>
                            <br>
                            <button id="submit" type="submit" name="btnModify" value ="<?php echo $cinema->getId()?>" class="btn btn-dark ml-auto d-block"> Modificar</button>
                         </div>
                         <?php
                            if (isset($message)) {
                                echo "<script> alert('$message'); </script>";
                            }
                        ?> 
              </form>
          </div>
     </secti