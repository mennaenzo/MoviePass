<?php
    require_once "nav.php";
?>
<main class="py-5">
     <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4" style="color: whitesmoke">Cartelera</h2>
            <div>
                <form id= "billboard" action="<?php echo FRONT_ROOT ?>Show/Filter" method="post" class="bg-light-alpha p-5">
                <label style="color: whitesmoke" for="lblGenres">Peliculas por Generos</label>
                <select name="SelectGenre">
                    <option value="0">Genero</option>
                    <?php foreach($genresList as $genres){?>
                            <option value="<?php echo $genres->getId(); ?>"> <?php echo $genres->getName(); ?></option>
                    <?php }?>
                </select>
                    <br>
                <input type="date" name="date" value="
                <?php
                    if(!isset($_POST["date"])){
                        echo date("Y-m-d");
                    }
                    else{
                        echo $_POST["date"];
                    }?>" class="form-control-xlg">
                <button type="submit" name="btnFilter" class="btn btn-danger" value="">Filtrar</button></a>
                </form>
            </div>
            <div>
            <table class="table table-dark">
                <thead>
                <th>Poster</th>
                <th>Title</th>
                <th>Description</th>
                <th>Language</th>
                <th>Adult</th>
                <th>Funciones</th>
                </thead>
                <tbody>
                    <tr>
                        <form id= "shows" action="<?php echo FRONT_ROOT ?>Show/ShowsView" method="post" class="bg-light-alpha p-5">
                            <?php foreach($movieList as $movie){ ?>
                                <tr>
                                <td><img src= <?php echo "https://image.tmdb.org/t/p/w154" .$movie->getImage();?>> </td>
                                <td><?php echo $movie->getName() ?></td>
                                <td><?php echo $movie->getSummary() ?></td>
                                <td>
                                    <?php if($movie->getLanguage() == "en"){
                                            echo "Ingles";
                                            }elseif($movie->getLanguage() == "fr"){
                                                echo "Frances";
                                            }elseif($movie->getLanguage() == "ja"){
                                                echo "Japones";
                                            }elseif($movie->getLanguage() == "es"){
                                                echo "Español";
                                            }elseif($movie->getLanguage() == "ko"){
                                                echo "Koreano";
                                            }
                                ?></td>
                                <td><?php echo $movie->getAdult() ? "Si" : "No"; ?></td>
                                <td>
                                    <button type="submit" name="btnShows" class="btn btn-danger" value="<?php echo $movie->getId();?>">Ver funciones</button>
                                </td>
                                </tr>
                            <?php }?>
                        </form>
                    </tr>
                
                </tbody>
            </table>
        </div>
     </section>
</main>