<?php

require_once VIEWS_PATH."nav.php";

?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4"style="color: #4e555b">Mis Entradas</h2>
                <table class="table table-dark">
                    <thead>
                        <th>Fecha</th>
                        <th>Cine</th>
                        <th>Direccion</th>
                        <th>Sala</th>
                        <th>Pelicula</th>
                        <th>Hora</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php foreach($ticketList as $ticket){ ?>
                           <tr> 
                                <div>
                                    <td> <?phP echo $ticket->getShow()->getDay()?></td>
                                    <td> <?php echo $ticket->getShow()->getRoom()->getNameCinema();?></td>
                                    <td> <?php echo $this->cinemaDAO->searchCinemaByName($ticket->getShow()->getRoom()->getNameCinema())->getAddress();?></td>
                                    <td> <?php echo $ticket->getShow()->getRoom()->getName();?></td>
                                    <td> <?php echo $ticket->getShow()->getMovie()->getName()?></td>
                                    <td> <?php echo $ticket->getShow()->getTime()?></td>
                                    <td> <?php echo $ticket->getQuantity();?></td>
                                    <td> <?php echo $ticket->getTotal();?></td>
                                </div>
                            </tr>
                        <?php } ?>
                    <tbody>
                    <br>
                </table>
                <?php
                if (isset($message)) {
                    echo "<script> alert('$message'); </script>";
                }
                ?>
            </div>
        </form>
    </section>
</main>
