<?php
     require_once('nav.php');
     ?>
     <main class="py-5">
         <section id="listado" class="mb-5">
             <div class="container">
                 <h2 class="mb-4" style="color: whitesmoke" >Listado de Salas</h2>
                 <table class="table table-dark">
                     <thead>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Capacidad</th>
                     </thead>
                     <tbody>
                         <tr>
                             <?php 
                                foreach($roomList as $room) {?>
                                    <tr>
                                        <td><?php  echo $room->getName();?></td> 
                                        <td><?php  echo $room->getRoom_price();?></td> 
                                        <td><?php  echo $room->getCapacity();?></td> 
                                        <td>
                                            <div class="form-group row justify-content-center">
                                                <form action="<?php echo FRONT_ROOT?> Show/ShowsList" method="POST">
                                                    <button style="margin: 10px" type="submit" formmethod="POST" name="btnSeeShow" class="btn btn-danger" value="<?php echo $room->getId();?>"> Ver funciones </button>
                                                </form>

                                                <form action="<?php echo FRONT_ROOT ?> Room/delete" method="POST">
                                                    <button style="margin: 10px" type="submit" formmethod="POST" name="btnRemove" class="btn btn-danger" value="<?php echo $room->getId();?>"> Eliminar </button>
                                                </form>

                                                <form action="<?php echo FRONT_ROOT ?>  Room/ShowModifyView" method="POST">
                                                <button style="margin: 10px" type="submit" formmethod="POST" name="btnModify" class="btn btn-danger" value="<?php echo $room->getId(); ?>"> Modificar </button>
                                                </form>
                                            <div>
                                        </td>
                                    </tr>     
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
                
                
                <?php 
                    if(isset($message)){ 
                        echo "<script> alert('$message'); </script>";
                    }
                ?> 
                   
         </section>
     </main>

