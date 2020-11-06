<?php require_once "nav.php";
//var_dump($genresList);?>

                <form action="<?php echo FRONT_ROOT . "Movie/DownloadMovies"?>" method="POST">
                    <button type="submit" name="" class="btn btn-danger" value="">Cargar Peliculas </button>
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

