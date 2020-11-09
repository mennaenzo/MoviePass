<?php
    namespace Controllers;

    use DAO\GenresDAO as GenresDAO;
    use DAO\MovieDAO as MovieDAO;
    use DAO\MoviesxGenresDAO as MoviesxGenresDAO;
    use Models\Genres as Genres;
    use Models\Movie as Movie;

    class UtilitiesController
    {

        public static function validateFieldNumber($fieldNumber)
        {
            if (validateField($fieldNumber) && is_numeric($fieldNumber) && $fieldNumber > 0) {
                return true;
            } else {
                return false;
            }
        }

        public static function validateField($field)
        {
            if (isset($field) && !empty($field)) {
                return true;
            } else {
                return false;
            }
        } 

        public static function setGenresDAO()
        {
            $genreDAO = new GenresDAO();

            $arrayGenre = json_decode(file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=" . KEY . "&language=es&page=1"), true);

            foreach ($arrayGenre["genres"] as $genre) {
                $genres = new Genres();
                $genres->setName($genre["name"]);
                $genres->setId($genre["id"]);
                //array_push($this->genresList, $genres);
                $genreDAO->Add($genres);
            }
        }

        public static function setMoviesNowPlaying()
        {
             $movieDAO = new MovieDAO();
             $moviesxGenresDAO = new MoviesxGenresDAO();

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
                 $movie->setRuntime(UtilitiesController::getRuntimeApi($valuesArray["id"]));

                 $movieDAO->Add($movie);
                 $moviesxGenresDAO->Add($movie->getGenres(), $movie->getId());
             }
        }

        public static function getRuntimeApi($idMovie){

            $jsonDetail = file_get_contents("https://api.themoviedb.org/3/movie/$idMovie?api_key=" . KEY . "&language=es&page=1");
            $arrayToDecode = ($jsonDetail) ? json_decode($jsonDetail, true) : array();

            return $arrayToDecode["runtime"];

        }
    }
?>