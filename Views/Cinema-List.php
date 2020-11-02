<?php

require_once VIEWS_PATH."nav.php";

?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de Cines</h2>
                <table class="table bg-light-alpha">
                    <thead>
                    <th>Name</th>
                    <th>Address</th>
                    <th>List Rooms</th>
                    <th>Add Room</th>
                    </thead>
                    <tbody>
                        <?php foreach($cinemaList as $cinema){ ?>
                           <tr> 
                                <div>
                                    <td><?php echo $cinema->getName();?></td>
                                    <td><?php echo $cinema->getAddress(); ?></td>
                                    <td>
                                        <!--<input type="checkbox" name="select" value="<?php// echo $cinema->getId()?>" required>No puede ser checkbox porque me pide que debo seleccionar todos-->
                                        <form action="<?php echo FRONT_ROOT ?>Room/ShowRoomListView_User" method="POST">
                                            <button type="submit" formmethod="POST" name="btnSeeRoom" class="btn btn-danger" value="<?php echo $cinema->getId()?>"> Rooms </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form >
                                        <button type="button" method="POST"  name="btnSeeRoom" class="btn btn-danger" value="2"> Agregar sala </button>
                                        </form>
                                    </td>
                                </div>
                             </tr>
                        <?php } ?>
                    </tbody>
                </table>
       
                <!--     <form action="<?php echo FRONT_ROOT ?>Cinema/Delete" method="POST">
                        <button type="submit" name="btnRemove" class="btn btn-danger" value=""> Eliminar </button>
                    </form>
                </td>
                <td>
                    <form action="<?php echo FRONT_ROOT ?>Cinema/ViewModify" method="POST">
                        <button type="submit" name="btnModify" class="btn btn-danger" value=""> Modificar </button>
                    </form>
                </td>  -->
             </div>             
                    <?php 
                        
                        if(isset($message)){ 
                            echo "<script> alert('$message'); </script>";
                        }
                    ?> 
                
    </section>
</main>

