<?php

require_once VIEWS_PATH."nav.php";

?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de Cines</h2>
                <table class="table bg-light-alpha"> 
                    <thead>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th></th>
                    </thead>
                    <tbody>
                        <?php foreach($cinemaList as $cinema){ ?>
                           <tr> 
                                <div>
                                    <td ><?php echo $cinema->getName();?></td>
                                    <td><?php echo $cinema->getAddress(); ?></td>
                                    <td>
                                    <div class="form-group row justify-content-center">
                                            <form action="<?php echo FRONT_ROOT ?>Room/ShowListRoomView" method="POST">
                                                <button style="margin: 10px" type="submit" formmethod="POST" name="btnSeeRoom" class="btn btn-danger" value="<?php echo $cinema->getId()?>"> Salas </button>
                                            </form>

                                            <form action="<?php echo FRONT_ROOT ?> Cinema/delete" method="POST">
                                                <button style="margin: 10px" type="submit" formmethod="POST" name="btnRemove" class="btn btn-danger" value="<?php echo $cinema->getId()?>"> Eliminar </button>
                                            </form>

                                            <form action="<?php echo FRONT_ROOT ?>Cinema/ShowModifyView" method="POST">
                                            <button style="margin: 10px" type="submit" formmethod="POST" name="btnModify" class="btn btn-danger" value="<?php echo $cinema->getId()?>"> Modificar </button>
                                        <div>
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

