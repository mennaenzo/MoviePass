<?php require_once "nav.php";
//var_dump($genresList);?>
    <main class="py-5">
        <section id="listado" class="mb-5">

            <div class="container">
                <h2 class="mb-4">Listado de Peliculas</h2>
                <form action="<?php echo FRONT_ROOT . "UserMenu"?>" method="POST">
                    <label for="">Select Movie</label>
                    <select name="selection">
                        <?php foreach($movieList as $room){ ?>
                            <option value="<?php echo $room->getName();?>"> <?php echo $room->getName();?> </option>
                        <?php } ?>
                    </select>

                    <button type="button" name="" class="btn btn-danger" value="">Siguiente </button>
                </form>

                <form action="<?php echo FRONT_ROOT . "UserMenu/"?>" method="POST">
                    <label for ="lblSearch">Genero</label>

                    <select name="searchGenre">
                        <?php
                        foreach($genresList as $genre){ ?>
                            <option value="<?php echo $genre->getIdApi();?>"><?php echo $genre->getName();?></option>
                        <?php } ?>
                    </select>
                    <button type="button" name="" class="btn btn-danger" value="">Filtrar </button>
                </form>
                <form>
                    <label for ="lblSearch"> Fecha </label>
                    <input type = "date" name="date"required>

                    <button type="button" name="" class="btn btn-danger" value="">Filtrar </button>
                </form>
                <table class="table bg-light-alpha">
                    <thead>
                    <th>Poster</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Language</th>
                    <th>Adult</th>
                    </thead>
                    <tbody>
                    <tr>
                        <?php foreach($movieList as $movie){ ?>
                        <td><img src= <?php echo "https://image.tmdb.org/t/p/w154" .$movie->getImage();?>> </td>
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


</div>

