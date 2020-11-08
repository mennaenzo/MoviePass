<?php
    require_once VIEWS_PATH . "nav.php";
?>
<main class="py-auto">
     <section id="listado" class="mb-5">
              <form id= "addShow" action="<?php echo FRONT_ROOT ?>Show/Add" method="post" class="bg-light-alpha p-5">
                  <header class="header">
                      <br>
                      <br>
                      <h2>Agregar funcion</h2>
                  </header>
                  <div class="sep"></div>
                         <div class="inputs">
                            <label for="lbldate">Dia</label>
                            <input type="date" name="date" value="" class="form-control" required>
                            <label for="lbltime">Hora</label>
                            <input type="time" name="hour" value="" class="form-control" required>

                            <label for="lblmovie">Pelicula</label>
                            <select name="SelectMovie">
                                    <?php foreach($movieList as $movie){?>
                                        <option value = "<?php echo $movie->getId();?>">
                                            <?php echo $movie->getName();?>
                                        </option>
                                    <?php } ?>
                            </select>

                            <label for="lblRoom">Sala</label>
                            <select name="SelectRoom">
                                    <?php foreach($cinemaList as $cinema){
                                        foreach(($this->roomDAO-> searchRoomsByIdCinema($cinema->getId())) as $room){ ?>
                                            <option value = "<?php echo $room->getId(); ?>">
                                                <?php echo $cinema->getName() . " -> " . $room->getName();?>
                                            </option>
                                        <?php } ?>
                                <?php }  
                            ?>
                            </select>
                            <br>
                            <button id="submit" type="submit" name="button" value ="" class="btn btn-dark ml-auto d-block">Agregar funcion</button>
                         </div>
              </form>
          </div>
         <?php
         if ($message <> "") {
             echo "<script> alert('$message'); </script>";
         }
         ?>