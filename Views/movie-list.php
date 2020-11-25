<?php
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 style="color: whitesmoke" class="mb-4">Listado de Peliculas</h2>
            <table class="table table-dark">
                <thead>

                <th>Title</th>
                <th>Description</th>
                <th>Language</th>
                <th>Adult</th>
                <th>Genres</th>
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

