<?php
    namespace DAO;
    use Models\Genres as Genres;
    use Models\Movie as Movie;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class MovieDAO{

        private $moviesList = array();
        private $tableName = "movies";
        private $tableName2 = "genres";
        private $genresList = array();

        public function Add(Movie $movie)
        {
            array_push($this->moviesList, $movie);
        }

        public function GetAll()
        {
            $this->getNowPlaying();
            return $this->moviesList;
        }
        public function GetGenres()
        {
            $this->getGenresFromApi();
            return $this->genresList;
        }

        public function getNowPlaying()
        {
            $object = json_decode(file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=" . KEY . "&language=es&page=1"), FALSE);
            //var_dump($object);
            foreach($object->results as $movie)
            {
                $newMovie = new Movie($movie->id, $movie->adult, $movie->title, $movie->overview, $movie->original_language, $movie->genre_ids);
                
                array_push($this->moviesList, $newMovie);
            }
        }

        public function addGenres(Genres $genres){
            try{
                $query = "INSERT INTO " . $this->tableName2 . "idApi, genreName VALUES (:idApi, :genreName) ON DUPLICATE KEY UPDATE idApi = idApi, genreName = genreName;";
                $this->connection = Connection:: GetInstance();
                $parameters["idApi"] = $genres->getIdApi();
                $parameters["genreName"] = $genres->getName();
                $result = $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch (Exception $ex){
                throw $ex;
            }
        }
        public function getGenresFromApi()
        {
            $arrayGenre = json_decode(file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=" . KEY . "&language=es&page=1"), TRUE);

            foreach ($arrayGenre["genres"] as $genre) {
                $genres = new Genres();
                $genres->setName($genre["name"]);
                $genres->setIdApi($genre["id"]);
                array_push($this->genresList, $genres);
            }
        }

    }
?>