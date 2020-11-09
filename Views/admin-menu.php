<?php
    require_once VIEWS_PATH . "nav.php";
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
             <div>
                <!-- <form action="<?php //echo FRONT_ROOT . "Movie/DownloadMovies"?>" method="POST">
                    <button type="submit" name="" class="btn btn-danger" value="">Cargar Peliculas </button>
                </form>
                <form action="<?php //echo FRONT_ROOT . "Genres/getGenresFromApi"?>" method="POST">
                    <button type="submit" name="" class="btn btn-danger" value="">Cargar Generos </button>
                </form> -->

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
        </div>
    </section>
</main>
