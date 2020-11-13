<?php
    namespace DAO;

    use Models\Genres as Genres;
    use Models\Movie as Movie;
    use \Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\MoviesxGenresDAO as MoviesxGenresDAO;

    class MovieDAO
    {
        private $moviesList = array();
        private $tableName = "Movies";
        private $tableName2 = "genres";
        private $tb_Shows = "shows";
        private $MoviesxGenresDAO;

        public function __construct(){
            $this->MoviesxGenresDAO = new MoviesxGenresDAO();
        }

        public function Add(Movie $movie)
        {
            /* array_push($this->moviesList, $movie);*/

            try {
                $query = "INSERT INTO " . $this->tableName . " (id, adult, movieName, summary, movieLanguage, dir_image, runtime, releaseDate) VALUES (:id, :adult, :movieName, :summary, :movieLanguage, :dir_image, :runtime, :releaseDate)
                on duplicate key update id=id , adult=adult, movieName=movieName , summary=summary , movieLanguage=movieLanguage , dir_image=dir_image , releaseDate=releaseDate;";
                //echo $query;

                $parameters["id"] = $movie->getId();
                $parameters["adult"] = $movie->getAdult() ? 1 : 0; //ver el tema del false
                $parameters["movieName"] = $movie->getName();
                $parameters["summary"] = $movie->getSummary();
                $parameters["movieLanguage"] = $movie->getLanguage();
                $parameters["dir_image"] = $movie->getImage();
                $parameters["runtime"] = $movie->getRuntime();
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
            try {
                $movieList = array();
                $query = "SELECT * FROM " . $this->tableName . ";";
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
                    $movie->setRuntime($row["runtime"]);
                    array_push($movieList, $movie);
                }
                return $movieList;

            } catch (Exception $ex) {
                throw $ex;
            }
        }

        public function getMoviesFromShows(){
            $movieList = array();
            try{
                $query = "SELECT m.id, movieName, summary, movieLanguage, dir_image, releaseDate  FROM " . $this->tableName . " m inner join Shows s on s.idMovie = m.id WHERE  s.statusShow = 1;";
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
                        array_push($movieList, $movie);
                    }
                }
            } catch (Exception $ex) {
                throw $ex;
            }
            return $movieList;
        }

        public function getMovieAvailable($date = 0, $genre = 0){
            $movieList = array();
            try{

                date_default_timezone_set("America/Argentina/Buenos_Aires");

                if($date == 0)
                {
                    $date = date("Y-m-d");
                }

                if($genre == 0)
                {
                    $query = "SELECT m.id FROM " . $this->tableName . " m inner join Shows s on s.idMovie = m.id WHERE showDay = '". $date . "';";
                }else{
                    $query = "select m.id from movies m 
                    inner join Shows s on s.idMovie = m.id
                    inner join movie_genres mxg on mxg.idMovie = m.id
                    where mxg.idGenre = $genre and showDay = '$date'
                    group by m.id;";
                }

                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);
               
                if($result != null){
                    foreach ($result as $row) {
                        $movie = new Movie();
                        $movie = $this->GetMovie($row["id"]);
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
            try 
            {   
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
                    $arrayGenres = $this->MoviesxGenresDAO->GetGenresByMovieId($id);
                    $aux = array();
                    foreach($arrayGenres as $genreId)
                    {
                        array_push($aux, $genreId["idGenre"]);
                    }
                    $movie->setGenres($aux);
                    $movie->setRuntime($row["runtime"]);
                   // $movie->setPlayingNow($row["playingNow"]);
                }
                
            } catch (Exception $ex) {
                throw $ex;
            }  

            return $movie;
        }
    }

?>