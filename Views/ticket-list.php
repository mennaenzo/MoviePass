<?php
    require_once "nav.php";
?>
<main class="py-5">
    <section id="listado" class="mb-5">

            <div class="container">
                <h2 class="mb-4"style="color: whitesmoke">Mis Entradas</h2>
                <div>
                    <form id= "ticketList" action="<?php echo FRONT_ROOT ?>Ticket/filter" method="post" class="bg-light-alpha p-5">
                        <label style="color: whitesmoke" for="lblGenres">Tickets por Pelicula</label>
                        <select name ="selectMovie">
                            <option value="0">Seleccionar pelicula</option>
                            <?php foreach($ticketFilter as $movie){ ?>
                                <option value="<?php echo $movie->getId(); ?>"> <?php echo $movie->getName(); ?> </option>
                            <?php }?>
                        </select>
                        <br>
                        <input type="hidden" name="User" value="<?php echo $user; ?>">
                        <label style="color: whitesmoke" for="lblGenres">Fecha </label>
                        <input type="date" name="date" value="" class="form-control-xlg">
                        <br>
                        <button type="submit" name="btnOrder" class="btn btn-danger" value="">Ordenar</button>
                    </form>
                </div>
         
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
                        <?php  foreach($ticketList as $ticket){ ?>
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
                    </tbody>
                    <br>
                </table>
                <?php
                if (isset($message)) {
                    echo "<script> alert('$message'); </script>";
                }
                ?>
            </div>  
    </section>       
</main>
