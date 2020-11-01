<?php require_once "nav.php";?>
    <main class="py-5">
        <section id="listado" class="mb-5">

            <form action="<?php echo FRONT_ROOT . "UserMenu"?>" method="POST">
                <label for ="lblSearch">Genero</label>

                <select name="searchGenre">
                    <option value="1"> Accion </option>
                    <option value="2"> Comedia </option>
                </select>
                <label for ="lblSearch"> Fecha </label>
               <input type = "date" name="date"required>

                <button type="submit" name="" class="btn btn-danger" value="">Filtrar </button>
            </form>
            <div class="container">
                <h2 class="mb-4">Listado de Peliculas</h2>
                <table class="table bg-light-alpha">
                    <thead>

                    <th>Title</th>
                    <th>Description</th>
                    <th>Language</th>
                    <th>Adult</th>
                    </thead>
                    <tbody>
                    <tr>
                        <?php foreach($movieList as $movie){ ?>
                        <td><?php echo $movie->getName() ?></td>
                        <td><?php echo $movie->getSummary() ?></td>
                        <td><?php echo $movie->getLanguage() ?></td>
                        <td><?php echo $movie->getAdult() ? "Si" : "No"; ?></td>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <form action="<?php echo FRONT_ROOT . "UserMenu"?>" method="POST">
        <select name="selection">
            <?php foreach($movieList as $room){ ?>
                <option value="<?php echo $room->getName();?>"> <?php echo $room->getName();?> </option>
            <?php } ?>
        </select>

        <button type="submit" name="" class="btn btn-danger" value="">Siguiente </button>
    </form>
</div>

