<?php
    use DAO\UserDAO as UserDAO;

if (isset($_SESSION['loggedUser'])) {
    $user = $_SESSION['loggedUser'];
    $userDao = new UserDAO();
    if (!$userDao->esAdmin($user)) {
        //Nav USUARIO
?>
    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
        <span class="navbar-text">
            <strong>Movie Pass</strong>
            <h4><strong><?php echo "Usuario: " . $userDao->getUserName($user); ?></strong></h4>
        </span>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/ShowListViewCinema_user">Lista de cine</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo FRONT_ROOT ?>Movie/ShowListView">Lista de peliculas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/ShowTicketsFromUser">Mis entradas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/Logout">Salir</a>
            </li>
        </ul>
    </nav>

    <?php
    } else { // Nav Administrador
        ?>
        <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <strong>Movie Pass</strong>
          <h4><strong><?php echo "Admin: " . $userDao->getUserName($user); ?></strong></h4>
     </span>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?> Cinema/ShowAddView">Agregar Cine</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?> Room/ShowAddRoom">Agregar Sala</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?> Show/ShowAddView">Agregar Funcion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?> Cinema/ShowListView">Listar Cines</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?> Movie/ShowListAdmin">Listar Peliculas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?> Movie/GetNowPlaying">Cargar Peliculas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?> Genres/getGenresFromApi">Cargar Generos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/Logout">Salir</a>
                </li>
            </ul>
        </nav>

<?php
        }
} else {
    header("Location: http://localhost:8080/MoviePass/");
}
?>