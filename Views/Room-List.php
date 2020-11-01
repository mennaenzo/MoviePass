<?php
     require_once('nav.php');
     ?>
     <main class="py-5">
         <section id="listado" class="mb-5">
             <div class="container">
                 <h2 class="mb-4">Listado de Salas</h2>
                 <table class="table bg-light-alpha">
                     <thead>
                        <th>Sala</th>
                        <th>Precio</th>
                        <th>Capacidad</th>
                     </thead>
                     <tbody>
                         <tr>
                             <?php foreach($roomList as $room) {
                                
                                        if($room->getNameCinema() == $option){?>
                                            <tr>
                                                <td><?php  echo $room->getName();?></td> 
                                                <td><?php  echo $room->getRoom_price();?></td> 
                                                <td><?php  echo $room->getCapacity();?></td> 
                                            </tr>     
                            <?php }} ?>
                        </tr>
                    </tbody>
                </table>
                <div>  
                    <form action="<?php echo FRONT_ROOT ?>Room/DeleteRoom" method="POST">
                        <select name="rooms">
                            <?php foreach($roomList as $room){ ?>
                            <option value="<?php echo $room->getName();?>"> <?php echo $room->getName();?> </option>    
                            <?php } ?>
                        </select>

                        <button type="submit" name="btnDelete" class="btn btn-danger" value=""> Eliminar </button>    
                    </form>
                </div>   
                
                <?php 
                    if(isset($message)){ 
                        echo "<script> alert('$message'); </script>";
                    }
                ?> 
                   
         </section>
     </main>

