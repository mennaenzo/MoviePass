<?php
    require_once('nav.php');
?>
<main class="py-auto">
     <section id="listado" class="mb-5">
              <form id= "addShow" action="<?php echo FRONT_ROOT ?>Show/Add" method="post" class="bg-light-alpha p-5">
                  <header class="header">
                      <br>
                      <br>
                      <h2 style="color: black">Agregar funcion</h2>
                  </header>
                  <div class="sep"></div>
                         <div class="inputs">
                            <label style="color: black" for="lbldate">Dia</label>
                            <input type="date" name="lbldate" value="<?php echo date("Y-m-d")?>"
                            min="<?php 
                                    $date = date("Y-m-d"); 
                                    $mod_date = strtotime('+1 day', strtotime($date)); 
                                    $nextDay = date("Y-m-d", $mod_date);
                                    echo $nextDay;
                                ?>" 
                            class="form-control" required>
                            <label style="color: #000000" for="lbltime">Hora</label>
                            <!-- <input type="time" name="hour" value="" class="form-control" required> -->
                            <input class="timepicker" name="hour">
                            <label style="color: black" for="lblmovie">Pelicula</label>
                            <select name="SelectMovie">
                                    <?php foreach($movieList as $movie){?>
                                        <option value = "<?php echo $movie->getId();?>">
                                            <?php echo $movie->getName();?>
                                        </option>
                                    <?php } ?>
                            </select>

                            <label style="color: black" for="lblRoom">Sala</label>
                            <select name="SelectRoom" id="selRoom">
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
          </section>
         <?php
         if ($message <> "") {
             echo "<script> alert('$message'); </script>";
         }
        ?>