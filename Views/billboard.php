<?php require_once "nav.php";
?>
                <h2>"BillBoard"</h2>
                <label for="lblGenres">Peliculas por Generos</label>
                <select name="SelectGenre">
                    <option value="">Genero</option>
                    <?php foreach($genresList as $genres){?>
                            <option value="<?php echo $genres->getId(); ?>"> <?php echo $genres->getName(); ?></option>
                    <?php }?>
                </select>
                <a href="<?php echo FRONT_ROOT . "Genres/getGenresFromApi"?>">
                    <button type="button" name="" class="btn btn-danger" value="">Peliculas por Genero </button></a>
                </a>
                <a href="<?php echo FRONT_ROOT . "Genres/getGenresFromApi"?>">
                    <button type="button" name="" class="btn btn-danger" value="">Peliculas por Fechas </button></a>
                </a>
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