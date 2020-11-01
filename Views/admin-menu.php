<?php
    require_once VIEWS_PATH . "nav.php";
?>

<main class="py-auto">
    <section id="listado" class="mb-5">
        <h1>¡¡Bienvenido!!</h1>
        <h2>¿Que operación desea realizar?</h3>
        <form action="<?php echo FRONT_ROOT?> AdminMenu/ShowAddCinemaView" method="POST">
            <div class="sep">
                    <button id="submitAdd" type="submit" name="btnAdd" class="btn btn-dark ml">Agregar Cine</button>
            </div>
        </form> 
        <form action="<?php echo FRONT_ROOT?> AdminMenu/ShowAddRoomView" method="POST">
            <div class="sep">
            <button id="submitListCinema" type="submit" name="btnListCinemas" class="btn btn-dark ml-">Lista de Cines</button>
            </div>
        </form> 
        <form action="<?php echo FRONT_ROOT?> AdminMenu/" method="POST">
            <div class="sep">
            <button id="submitListMovie" type="submit" name="btnListMovies" class="btn btn-dark ml">Lista de Peliculas</button>
            </div>
        </form> 
    </section>
</main>
