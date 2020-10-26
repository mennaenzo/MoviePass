<?php

require_once(VIEWS_PATH."nav.php");

?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de Cines</h2>
            <table class="table bg-light-alpha">
                <thead>

                <th>Name</th>
                <th>Address</th>
                
                </thead>
                <tbody>
                    <tr> 
                        <tr>
                            <?php foreach($cinemaList as $cinema){ ?>
                            <td><?php echo $cinema->getName();?></td>
                            <td><?php echo $cinema->getAddress(); ?></td>
                        </tr>
                        <?php } ?>
                    </tr>
                </tbody>
            </table>

           <form action="<?php echo FRONT_ROOT ?>Room/ShowListView" method="POST">
                
                <select name="seeCinemas">
                        <?php foreach($cinemaList as $cinema){ ;?>
                            <option value="<?php echo $cinema->getName();?>"> <?php echo $cinema->getName();?> </option>    
                        <?php } ?>
                </select>  
            
                <button type="submit" formmethod="POST" name="btnSeeRoom" class="btn btn-danger" value="<?php echo $cinema->getName();?>"> Ver Salas </button>
   
                 </form> 
                <!-- <form action="<?php echo FRONT_ROOT ?>Cinema/ShowAddRoomView" method="POST">
                <select name="seeCinemass">
                                <?php foreach($cinemaList as $cinema){ ?>
                                    <option value="<?php echo $cinema->getName();?>"> <?php echo $cinema->getName();?> </option>    
                            <?php } ?>
                            </select>  
                        <button type="submit" formmethod="POST"  name="btnSeeRoom" class="btn btn-danger" value="<?php echo $cinema->getName();?>"> Agregar sala </button>    
                    
                    </form> 
            -->
                   
                    
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

