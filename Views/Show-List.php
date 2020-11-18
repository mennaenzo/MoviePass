<?php
     require_once('nav.php');
?>
     <main class="py-5">
         <section id="listado" class="mb-5">
             <div class="container">
                 <h2 class="mb-4">Listado de Funciones</h2>
                 <table class="table table-dark">
                     <thead>
                        <th>Dia</th>
                        <th>Hora</th>
                        <th>Pelicula</th>
                        <th>Lugar</th>
                     </thead>
                     <tbody>
                         <tr>
                             <?php 
                                foreach($showList as $show) {?>
                                    <tr>
                                        <td><?php echo $show->getDay();?></td> 
                                        <td><?php echo $show->getTime();?></td> 
                                        <td><?php echo $show->getMovie()->getName();?></td>
                                        <td><?php echo $show->getRoom()->getName();?></td>  
                                        <td>
                                            <div class="form-group row justify-content-center">
                                                    <form action="<?php echo FRONT_ROOT ?> " method="POST">
                                                        <button style="margin: 10px" type="submit" formmethod="POST" name="btnRemove" class="btn btn-danger" value="<?php ?>"> Eliminar </button>
                                                    </form>

                                                    <form action="<?php echo FRONT_ROOT ?> " method="POST">
                                                    <button style="margin: 10px" type="submit" formmethod="POST" name="btnModify" class="btn btn-danger" value="<?php ?>"> Modificar </button>
                                            <div>
                                        </td>
                                    </tr>     
                            <?php } ?>
                        </tr>
                    </tbody>
                 </table>
             </div>
         </section>
     </main>