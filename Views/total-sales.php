<?php
    require_once "nav.php";
?>

<main class="py-5">
    <section id="listado" class="mb-5">

            <div class="container">
                <h2 class="mb-4"style="color: whitesmoke">Total Ventas</h2>
                <div>
                    <form id="totals" action="<?php echo FRONT_ROOT ?>Show/ShowTotalSales" method="post" class="bg-light-alpha p-5">
                        <label style="color: whitesmoke" for="lblGenres">Cines</label>
                        <select name="SelectCine">
                            <option value = "0">Seleccione el cine</option>
                            <?php foreach ($cineList as $cine) {?>
                                <option value = "<?php echo $cine->getId();?>">
                                    <?php echo $cine->getName();?>
                                </option>
                            <?php } ?>
                        </select>
                        <label style="color: whitesmoke" for="lblGenres">Peliculas</label>
                        <select name="SelectMovie">
                            <option value = "0">Seleccione la pelicula</option>
                            <?php foreach ($movieList as $movie) {?>
                                <option value = "<?php echo $movie->getId();?>">
                                    <?php echo $movie->getName();?>
                                </option>
                            <?php } ?>
                        </select>
                        <div>
                            <label style="color: whitesmoke" for="lbldate1">Fecha Desde</label>
                            <input type="date" name="dateSince" value="<?php echo date("2020-01-01");?>" class="form-control-xlg" required>
                            <label style="color: whitesmoke" for="lbldate2">Fecha Hasta</label>
                            <input type="date" name="dateUntil" value="<?php echo date("2025-01-01");?>" class="form-control-xlg" required>
                        <button type="submit" name="btnFilter" class="btn btn-danger" value="">Filtrar</button>
                        </div>
                    </form>
                </div>
         
                <table class="table table-dark">
                    <thead>
                        <th>Cine</th>
                        <th>Sala</th>
                        <th>Pelicula</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Total</th>
                    </thead>
                    <tbody>
                        <?php for($i = 0; $i < count($showList) ; $i++) { 
                                $show = $showList[$i];
                            ?>
                           <tr> 
                                <div>
                                    <td> <?php echo $show["show"]->getRoom()->getNameCinema();?> </td>
                                    <td> <?php echo $show["show"]->getRoom()->getName();?> </td>
                                    <td> <?php echo $show["show"]->getMovie()->getName();?> </td>
                                    <td> <?php echo $show["show"]->getDay();?> </td>
                                    <td> <?php echo $show["show"]->getTime();?> </td>
                                    <td> <?php echo "$" . $show["cant"];?> </td>
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