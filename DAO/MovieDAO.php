<?php
    namespace DAO;

    use Models\Genres as Genres;
    use Models\Movie as Movie;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class MovieDAO
    {
        private $moviesList = array();
        private $tableName = "Movies";
        private $tableName2 = "genres";

        ///private $genresList = array();

        public function Add(Movie $movie)
        {
            /* array_push($this->moviesList, $movie);*/

            try {

                $query = "INSERT INTO " . $this->tableName . " (id, adult, movieName, summary, movieLanguage, dir_image, playingNow, releaseDate) VALUES (:id, :adult, :movieName, :summary, :movieLanguage, :dir_image, :playingNow, :releaseDate)
                on duplicate key update id=id , adult=adult, movieName=movieName , summary=summary , movieLanguage=movieLanguage , dir_image=dir_image , releaseDate=releaseDate;";
                //echo $query;

                $parameters["id"] = $movie->getId();
                $parameters["adult"] = $movie->getAdult() ? 1 : 0; //ver el tema del false
                $parameters["movieName"] = $movie->getName();
                $parameters["summary"] = $movie->getSummary();
                $parameters["movieLanguage"] = $movie->getLanguage();
                $parameters["dir_image"] = $movie->getImage();
                $parameters["playingNow"] = $movie->getPlayingNow();
                $parameters["releaseDate"] = $movie->getReleaseDate();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

            } catch (Exception $ex) {
                throw $ex;
            }

        }

        //Ver implementacion de este metodo
        public function GetAll()
        {
            /*
            $this->getNowPlaying();
            return $this->moviesList;
            */

            try {
                $movieList = array();
                $query = "SELECT * FROM " . $this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row) {
                    $movie = new Movie();
                    $movie->setId($row["id"]);
                    $movie->setName($row["movieName"]);
                    $movie->setSummary($row["summary"]);
                    $movie->setLanguage($row["movieLanguage"]);
                    $movie->setImage($row["dir_image"]);
                    $movie->setReleaseDate($row["releaseDate"]);
                    //$movie->setGenres($this->GetGenres($row["id_movie_api"]));
                    $movie->setPlayingNow($row["playingNow"]);
                    array_push($movieList, $movie);
                }
                return $movieList;

            } catch (Exception $ex) {
                throw $ex;
            }
        }

        public function GetGenres()
        {
            $this->getGenresFromApi();
            return $this->genresList;
        }

        /*
        public function GetNowPlaying()
    {*/
        /*
        $object = json_decode(file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=" . KEY . "&language=es&page=1"), false);
        //var_dump($object);
        foreach ($object->results as $movie) {
            $newMovie = new Movie($movie->id, $movie->adult, $movie->title, $movie->overview, $movie->original_language,$movie->poster_path, $movie->genre_ids);

            array_push($this->moviesList, $newMovie);
        }
        */
        /*
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
*/
        /* $arrayGenres=array();

         foreach($valuesArray["genre_ids"] as $values){
             array_push($arrayGenres,$values);
         }
         $movie->setGenres($arrayGenres);
         *//*
                $movie->setPlayingNow(0);

                ///var_dump($movie);
                $this->Add($movie);
                //$this->AddMovieXGenres($arrayGenres,$valuesArray["id"]);

            }
        }
*/
        public function addGenres(Genres $genres)
        {
            try {
                $query = "INSERT INTO " . $this->tableName2 . "idApi, genreName VALUES (:idApi, :genreName) ON DUPLICATE KEY UPDATE idApi = idApi, genreName = genreName;";
                $this->connection = Connection:: GetInstance();
                $parameters["idApi"] = $genres->getIdApi();
                $parameters["genreName"] = $genres->getName();
                $result = $this->connection->ExecuteNonQuery($query, $parameters);
            } catch (Exception $ex) {
                throw $ex;
            }
        }

        public function getGenresFromApi()
        {
            $arrayGenre = json_decode(file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=" . KEY . "&language=es&page=1"), true);

            foreach ($arrayGenre["genres"] as $genre) {
                $genres = new Genres();
                $genres->setName($genre["name"]);
                $genres->setIdApi($genre["id"]);
                array_push($this->genresList, $genres);
            }
        }

        public function getMovieAvailable(){
            $movieList = array();
            try{
                $query = "SELECT * FROM " . $this->tableName . " WHERE playingNow = 0;";
            
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);
               
                if($result != null){
                    foreach ($result as $row) {
                        $movie = new Movie();
                        $movie->setId($row["id"]);
                        $movie->setName($row["movieName"]);
                        $movie->setSummary($row["summary"]);
                        $movie->setLanguage($row["movieLanguage"]);
                        $movie->setImage($row["dir_image"]);
                        $movie->setReleaseDate($row["releaseDate"]);
                        $movie->setPlayingNow($row["playingNow"]);
                        array_push($movieList, $movie);
                    }
                }
            } catch (Exception $ex) {
                throw $ex;
            }
            return $movieList;
        }

        ///Funcion que retorna una movie buscandola por id
        public function GetMovie($id)
        {
            try {   
                $query = "SELECT * FROM " . $this->tableName . " where id=$id;";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                $movie = new Movie();

                foreach ($resultSet as $row) {
                    $movie->setId($row["id"]);
                    $movie->setAdult($row["adult"]);
                    $movie->setName($row["movieName"]);
                    $movie->setSummary($row["summary"]);
                    $movie->setLanguage($row["movieLanguage"]);
                    $movie->setImage($row["dir_image"]);
                    $movie->setReleaseDate($row["releaseDate"]);
                    $movie->setGenres($this->GetGenres($row["id"]));
                    $movie->setPlayingNow($row["playingNow"]);
                }
            } catch (Exception $ex) {
                throw $ex;
            }  
            return $movie;
        }
    }

?>