<?php
    require_once "nav.php";
?>

<main class="py-5">
    <section id="listado" class="mb-5">

            <div class="container">
                <h2 class="mb-4"style="color: #4e555b">Total Ventas</h2>
                <div>
                    <form id="movies" action="<?php echo FRONT_ROOT ?>Shows/ShowTotalSales" method="post" class="bg-light-alpha p-5">
                        <label style="color: black" for="lblGenres">Cines</label>
                        <select name="SelectCine">
                            <option value = "0">Seleccione el cine</option>
                            <?php foreach ($cineList as $cine) {?>
                                <option value = "<?php echo $cine->getId();?>">
                                    <?php echo $cine->getName();?>
                                </option>
                            <?php } ?>
                        </select>
                        <label style="color: black" for="lblGenres">Peliculas</label>
                        <select name="SelectMovie">
                            <option value = "0">Seleccione la pelicula</option>
                            <?php foreach ($movieList as $movie) {?>
                                <option value = "<?php echo $movie->getId();?>">
                                    <?php echo $movie->getName();?>
                                </option>
                            <?php } ?>
                        </select>
                        <label style="color: whitesmoke" for="lbldate">Fecha</label>
                        <input type="date" name="date" value="<?php echo date("Y-m-d")?>" class="form-control-xlg" required>

                        <button type="submit" name="btnFilter" class="btn btn-danger" value="">Filtrar</button>
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