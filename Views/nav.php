<?php
    if (isset($_SESSION['loggedUser']))

        $user= $_SESSION['loggedUser'];

    if($user>=5){

    //Nav USUARIO
        ?>

        <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
         <span class="navbar-text">
              <h1><strong>MoviePass</strong></h1>
         </span>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>>List Cinema</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Movie/ShowListView">List Movie</a>
                </li>
               <!-- </li>
                <a class="nav-link" href="<?php echo FRONT_ROOT ?>Room/ShowListView">List Room</a>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Show/ShowListView">List Show</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/Logout">Logout</a>
                </li>
            </ul>

        </nav>

    <?php }
    else // Nav Administrador
    {
        ?>
        <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <strong>Movie Pass</strong>
     </span>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?> Cinema/ShowAddView">Agregar Cine</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?> Cinema/ShowListView">Listar Cine</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?> Movie/ShowListView">Listar Pelicula</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/Logout">Logout</a>
                </li>
            </ul>
        </nav>

        <?php
    }
    ?>