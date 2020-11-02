<?php

require_once VIEWS_PATH."nav.php";

?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de Cines</h2>
            <form action="<?php echo FRONT_ROOT ?>Room/ShowListView" method="POST">
                <table class="table bg-light-alpha">
                    <thead>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Opciones</th>
                    </thead>
                    <tbody>
                        <?php foreach($cinemaList as $cinema){ ?>
                           <tr> 
                                <div>
                                    <td><?php echo $cinema->getName();?></td>
                                    <td><?php echo $cinema->getAddress(); ?></td>
                                    <td>
                                        <input type="checkbox" name="select" value="<?php echo $cinema->getId()?>" required>
                                        <button type="submit" formmethod="POST" name="btnSeeRoom" class="btn btn-danger" value="1"> Ver Salas </button>
                                        <button type="submit" formmethod="POST"  name="btnSeeRoom" class="btn btn-danger" value="2"> Agregar sala </button>    
                                    </td>
                                </div>
                             </tr>
                        <?php } ?>
                    </tbody>
                </table>
  </form> 
       
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

