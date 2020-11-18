<?php
    namespace Controllers;
    use Controllers\UtilitiesController as Utilities;

    class HomeController
    {
        public function Index($message = "")
        {
           // Utilities::setGenresDAO();
            //UtilitiesController::setMoviesNowPlaying();
            require_once(VIEWS_PATH."index.php");
        }
    }
?>