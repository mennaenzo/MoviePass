<?php
    namespace Controllers;

    use DAO\MovieDAO as MovieDAO;

    class MovieController{

        private $MovieDAO;

        public function __construct()
        {
            $this->MovieDAO = new MovieDAO();
        }

        public function ShowListView()
        {
            $movieList = $this->MovieDAO->GetAll();
            $genresList = $this->MovieDAO->GetGenres();

            require_once(VIEWS_PATH . "user-menu.php");
        }
    }
?>