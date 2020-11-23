<?php
   require_once('nav.php');
?>
<main class="py-auto">
    <section id="listado" class="mb-5">
        <form id= "addRoom" action="<?php echo FRONT_ROOT ?>Room/addRoom" method="post" class="bg-light-alpha p-5">
            <header class="header">
                <h2 style="color: whitesmoke">Agregar Sala</h2>
            </header>
            <div class="sep"></div>
            <div class="inputs">
                <label style="color: whitesmoke" for="">Seleccione el cine</label>
                    <select name="comboBox" class="">
                        <?php 
                        if(($cinemaAdd->getName()) != null){ ?>
                            <option value="<?php echo $cinemaAdd->getId();?>"> <?php echo $cinemaAdd->getName();?></option>
                        <?php  
                        }else{
                            foreach ($cinemaList as $cinema){ ?>
                                <option value="<?php echo $cinema->getId();?>"><?php echo $cinema->getName();?></option>
                        <?php } 
                        } ?>
                    </select>
                 <br>
                <label style="color: whitesmoke" for="nameRoom">Nombre de la Sala</label>
                <input type="text" name="name" value="" class="form-control-xlg" required>
                <br>
                <label style="color: whitesmoke" for="numberOfRoom">Precio de la Sala</label>
                <input type="number" name="room_price" value="" class="form-control-xlg" required>
                <br>
                <label style="color: whitesmoke" for="numberOfSeats">Cantidad de butacas</label>
                <input type="number" name="capacity" value="" class="form-control-xlg" min="1" max="500" required>

                <br>
                <button id="submit" type="submit" name="button" value = "<?php ?>" class="btn btn-dark ml-auto">Agregar</button>
                    
                </div>
                </div>
                </form>

                <a href="<?php echo FRONT_ROOT ?>User/ShowMovieListAdmin">
                    <button class="btn btn-dark ml-auto d-block">Cancelar</button>
                </a>  
                
            <?php
            if($message <> ""){
                echo "<script> alert('$message'); </script>";
            }
            ?>
      
        </div>
    </section>

</main>
