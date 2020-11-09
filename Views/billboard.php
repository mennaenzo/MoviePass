<?php require_once "nav.php";
?>
<main class="py-auto">
     <section id="listado" class="mb-5">
        <div>
            <h2 class="mb-4"style="color: #4e555b">"Cartelera"</h2>
            <form id= "billboard" action="<?php echo FRONT_ROOT ?>Show/Filter" method="post" class="bg-light-alpha p-5">
            <label style="color: black" for="lblGenres">Peliculas por Generos</label>
            <select name="SelectGenre">
                <option value="0">Genero</option>
                <?php foreach($genresList as $genres){?>
                        <option value="<?php echo $genres->getId(); ?>"> <?php echo $genres->getName(); ?></option>
                <?php }?>
            </select>
            <input type="date" name="date" value="" class="form-control">
            <a href="<?php echo FRONT_ROOT . "Shows/ShowListView"?>">
                <button type="submit" name="btnFilter" class="btn btn-danger" value="">Filtrar</button></a>
            </a>
            </form>
            <table class="table table-dark">
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