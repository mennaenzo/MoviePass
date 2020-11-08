<?php
    namespace Controllers;

    use DAO\MovieDAO as MovieDAO;
    use Models\Movie as Movie;

    class MovieController
    {
        private $MovieDAO;

        public function __construct()
        {
            $this->MovieDAO = new MovieDAO();
        }

        public function ShowListView()
        {
            $movieList= $this->MovieDAO->GetAll();
            //var_dump($movieList);
            //$genresList = $this->MovieDAO->GetGenres();

            require_once(VIEWS_PATH . "user-menu.php");
        }

        public function DownloadMovies(){
            $this->GetNowPlaying();
            $this->ShowListView();
        }

        public function GetNowPlaying()
        {
            /*
            $object = json_decode(file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=" . KEY . "&language=es&page=1"), false);
            //var_dump($object);
            foreach ($object->results as $movie) {
                $newMovie = new Movie($movie->id, $movie->adult, $movie->title, $movie->overview, $movie->original_language,$movie->poster_path, $movie->genre_ids);

                array_push($this->moviesList, $newMovie);
            }
            */
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

                /* $arrayGenres=array();

                 foreach($valuesArray["genre_ids"] as $values){
                     array_push($arrayGenres,$values);
                 }
                 $movie->setGenres($arrayGenres);
                 */
                $movie->setPlayingNow(0);

                ///var_dump($movie);
                $this->MovieDAO->Add($movie);
                //$this->AddMovieXGenres($arrayGenres,$valuesArray["id"]);

            }
        }

        public function manageMovieView(){
            if($_POST["button"]) {
                $movie = $this->MovieDAO->GetMovie($_POST["button"]);
                require_once(VIEWS_PATH . "movie-manage.php");
            }
        }
        public function changePlayingNow($id,$name,$playingNow){
            $movie= new Movie();
            $movie->setId($id);
            $movie->setName($name);
            $movie->setPlayingNow($$playingNow);

            $this->MovieDAO->changePlayingNow($movie);
            $this->ShowListView();
        }


    }
?>