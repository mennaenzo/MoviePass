<?php
     require_once('nav.php');
?>
     <main class="py-5">
         <section id="listado" class="mb-5">
             <div class="container">
                 <h2 class="mb-4" style="color: whitesmoke">Listado de Funciones</h2>
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
                                             <form action="<?php echo FRONT_ROOT ?>Ticket/TicketToBuy" method="POST">
                                                 <button style="margin: 10px" type="submit" formmethod="POST" name="button" class="btn btn-danger" value="<?php echo $show->getId()?>"> Comprar Entrada </button>
                                             </form>
                                        </td>
                                    </tr>     
                            <?php } ?>
                        </tr>
                    </tbody>