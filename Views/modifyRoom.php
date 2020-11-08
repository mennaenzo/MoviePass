<?php
    require_once('nav.php');
?>
<main class="py-auto">
     <section id="listado" class="mb-5">
              <form id= "addRoom" action="<?php echo FRONT_ROOT ?>Room/modify" method="post" class="bg-light-alpha p-5">
                  <header class="header">
                      <br>
                      <br>
                      <h2>Modificar Sala</h2>
                  </header>
                  <div class="sep"></div>
                         <div class="inputs">
                            <label for="nameRoom">Nombre de la Sala</label>
                            <input type="text" name="name" value="<?php echo $room->getName()?>" class="form-control" required>
                             
                            <label for="numberOfRoom">Precio de la Sala</label>
                            <input type="number" name="room_price" value="<?php echo $room->getRoom_price()?>" class="form-control" min="1" required>
                             
                            <label for="numberOfSeats">Cantidad de butacas</label>
                            <input type="number" name="capacity" value="<?php echo $room->getCapacity()?>" class="form-control" min="1" max="500" required>
                             
                            <br>
                            <button id="submit" type="submit" name="btnModify" value = "<?php echo $room->getId(); ?>" class="btn btn-dark ml-auto d-block">Modificar</button>
                            
                         </div>
                         <?php 
                            if(isset($message)){  
                                echo "<script> alert('$message'); </script>";
                            }                      
                        ?> 
              </form>
          </div>
     </section>

</main>

