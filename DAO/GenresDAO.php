<?php

    namespace DAO;

    use DAO\Connection as Connection;
    use Models\Genres as Genres;
    use \Exception as Exception;

    class GenresDAO
    {
        private $connection;
        private $tableName = "Genres";
        //private $tableName2 = "Movies";

        public function Add(Genres $genre)
        {
            try {
                $query = "INSERT INTO ".$this->tableName." (id, genreName) VALUES (:id, :genreName) on duplicate key update id=id , genreName=genreName;";

                $parameters["id"]=$genre->getId();
                $parameters["genreName"] = $genre->getName();
                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            } catch (Exception $ex) {
                throw $ex;
            }
        }

        public function GetAll()
        {
            try {
                $genresList= array();

                $query = "SELECT * FROM ". $this->tableName.";";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row) {
                    $genre= new Genres();
                    $genre->setName($row["genreName"]);
                    $genre->setId($row["id"]);
                    array_push($genresList, $genre);
                }
                return $genresList;
            } catch (Exception $ex) {
                throw $ex;
            }
        }
    }

?>