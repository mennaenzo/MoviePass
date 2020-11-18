<?php
    namespace Controllers;

    use DAO\MovieDAO as MovieDAO;
    use Models\Movie as Movie;
    use DAO\MoviesxGenresDAO as MoviesxGenresDAO;

    class MovieController
    {
        private $MovieDAO;
        private $MoviesxGenresDAO;

        public function __construct()
        {
            $this->MovieDAO = new MovieDAO();
            $this->MoviesxGenresDAO = new MoviesxGenresDAO();

        }

        public function ShowListView()
        {
            $movieList= $this->MovieDAO->getMoviesFromShows();
            $genresList = $this->MoviesxGenresDAO->GetGenresByShows();
            require_once(VIEWS_PATH . "billboard.php");
        }

        public function ShowListAdmin()
        {
            $movieList= $this->MovieDAO->GetAll();
            require_once(VIEWS_PATH . "admin-menu.php");
        }

         public function DownloadMovies(){
             $this->GetNowPlaying();
             $this->ShowListView();
         }

         public function GetNowPlaying()
         {
             $jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=" . KEY . "&language=es&page=1");

             $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

             foreach($arrayToDecode["results"] as $valuesArray)
             {
                 $movie = new Movie();
                 $movie->setAdult($valuesArray["adult"]);
                 $movie->setId($valuesArray["id"]);
                 $movie->setName($valuesArray["original_title"]);
                 $movie->setLanguage($valuesArray["original_language"]);
                 $movie->setImage($valuesArray["poster_path"]);
                 $movie->setSummary($valuesArray["overview"]);
                 $movie->setReleaseDate($valuesArray["release_date"]);
                 $movie->setGenres($valuesArray["genre_ids"]);
                 $movie->setRuntime($this->getRuntimeApi($valuesArray["id"]));

                 ///var_dump($movie);
                 $this->MovieDAO->Add($movie);
                 $this->MoviesxGenresDAO->Add($movie->getGenres(), $movie->getId());

                 $this->ShowListAdmin();
                /// $this->AddMovieXGenres($arrayGenres,$valuesArray["id"]);

             }
         }

        public function getRuntimeApi($idMovie){

            $jsonDetail = file_get_contents("https://api.themoviedb.org/3/movie/$idMovie?api_key=" . KEY . "&language=es&page=1");
            $arrayToDecode = ($jsonDetail) ? json_decode($jsonDetail, true) : array();

            return $arrayToDecode["runtime"];

        }

        public function manageMovieView(){
            if($_POST["button"]) {
                $movie = $this->MovieDAO->GetMovie($_POST["button"]);
                require_once(VIEWS_PATH . "movie-manage.php");
            }
        }

        // public function changePlayingNow($id,$name,$playingNow){
        //     $movie= new Movie();
        //     $movie->setId($id);
        //     $movie->setName($name);
        //     $movie->setPlayingNow($$playingNow);

        //     $this->MovieDAO->changePlayingNow($movie);
        //     $this->ShowListView();
        // }

    }
?>