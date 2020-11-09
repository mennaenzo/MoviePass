<?php


namespace DAO;

use DAO\Connection as Connection;
use Models\Genres as Genres;
use Models\Movie as Movie;
use DAO\MovieDAO as MovieDAO;
use \Exception as Exception;


class MoviesxGenresDAO
{
    private $connection;
    private $tableName = "Movie_Genres";
    private $movieDAO;

    public function Add($arrayGenre, $idMovie)
    {
        try
        {
            foreach ($arrayGenre as $idGenre){
                $query = "INSERT INTO ".$this->tableName." (idMovie, idGenre) VALUES (:idMovie, :idGenre);";

                $parameters["idMovie"]=$idMovie;
                $parameters["idGenre"] =$idGenre;
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);

            }

        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }

    public function GetGenresByMovieId($idMovie)
    {
        try{
            $query = "SELECT idGenre FROM " . $this->tableName . " WHERE idMovie = $idMovie;";
                
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);
            //SIN TERNINAR, FALTA RECORRER RESULT
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
        return $result;
    }

    public function GetMoviesByGenreId($idGenre)
    {

        $movieList = array();
        try{
            $query = "select m.id from movies m 
            inner join Shows s on s.idMovie = m.id
            inner join movie_genres mxg on mxg.idMovie = m.id
            where mxg.idGenre = $idGenre
            group by m.id;";
               
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);

            $movieDAO = new MovieDAO();
            foreach ($result as $row) {
                $movie = new Movie();
                $movie = $movieDAO->GetMovie($row["id"]);
                array_push($movieList, $movie);
            }
            return $movieList;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
        return $result;
    }

    public function GetGenresByShows()
    {
        $genresList = array();
        try
        {
            $query = "SELECT g.id, g.genreName, s.idMovie FROM " . $this->tableName . " mxg 
            INNER JOIN Genres g ON mxg.idGenre=g.id
            INNER JOIN Shows s ON mxg.idMovie=s.idMovie
            group by mxg.idGenre;";
            //echo $query;
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);

            foreach ($result as $row) {
                $genre= new Genres();
                $genre->setName($row["genreName"]);
                $genre->setId($row["id"]);
                array_push($genresList, $genre);
            }
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
        return $genresList;
    }  
}