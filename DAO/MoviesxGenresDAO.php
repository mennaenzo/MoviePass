<?php


namespace DAO;

use DAO\Connection as Connection;
use Models\Genres as Genres;
use Models\Movie as Movie;
use \Exception as Exception;


class MoviesxGenresDAO
{
    private $connection;
    private $tableName = "Movie_Genres";

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
        $query = "SELECT idGenre FROM " . $this->tableName . " WHERE idMovie = $idMovie;";
            
        $this->connection = Connection::GetInstance();
        $result = $this->connection->Execute($query);

        return $result;
    }
}