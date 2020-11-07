<?php
   // require_once('nav.php');
?>
<main class="py-auto">
    <section id="listado" class="mb-5">
        <form id= "addRoom" action="<?php echo FRONT_ROOT ?>Room/addRoom" method="post" class="bg-light-alpha p-5">
            <header class="header">
                <h2>Agregar Sala</h2>
            </header>
            <div class="sep"></div>
            <div class="inputs">
                <label for="">Seleccione el cine</label>
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
                <label for="nameRoom">Nombre de la Sala</label>
                <input type="text" name="name" value="" class="form-control" required>

                <label for="numberOfRoom">Precio de la Sala</label>
                <input type="number" name="room_price" value="" class="form-control" required>

                <label for="numberOfSeats">Cantidad de butacas</label>
                <input type="number" name="capacity" value="" class="form-control" min="1" max="500" required>

                <br>
                <button id="submit" type="submit" name="button" value = "<?php ?>" class="btn btn-dark ml-auto d-block">Agregar</button>
               
                </div>
                </form>
                <div>         
                    <form id= "Cancelar" action="<?php echo FRONT_ROOT ?>Room/cancelRoom" method="post" class="bg-light-alpha p-5">
                            
                        <button id="submit" type="submit" name="return" value = "<?php $cinemaAdd->getId(); ?>" class="btn btn-dark ml-auto d-block">Cancelar</button>
                    </form>
                </div>
            <?php
            if(isset($message)){
                echo "<script> alert('$message'); </script>";
            }
            ?>
      
        </div>
    </section>

</main>
