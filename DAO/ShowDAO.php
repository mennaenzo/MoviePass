<?php
    namespace DAO;

    use DAO\IShowDAO as IShowDAO;
    use DAO\CinemaDAO as CinemaDAO;
    use Models\Cinema as Cinema;
    use Models\Room as Room;
    use Models\Show as Show;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class ShowDAO implements IShowDAO
    {
        ///private $roomList = array();
        private $connection;
        private $tableName = "Shows";
        private $roomDAO;
        private $movieDAO;

        public function __construct(){
            $this->roomDAO=new RoomDAO();
            $this->movieDAO=new MovieDAO();
        }

        public function Add(Show $show){
            try{
                $query = "INSERT INTO " . $this->tableName . "showTime, showDay, idMovie, idRoom VALUES (:showTime, :showDay, :idMovie, :idRoom);";
                $parameters["showTime"] = $show->getTime();
                $parameters["dayTime"] = $show->getDay();
                $parameters["idMovie"] = $show->getMovie()->getId();
                $parameters["idRoom"] = $show->getRoom()->getId();
                $this->conecction->GetInstance();
                $this->connection->ExecuteNonQuery($query,$parameters);

            }catch(Exception $ex){
                throw $ex;
                return 0;
            }
            

        }
        // Ver implementacion
        public function GetAll(){
             $showList = array();
            try{
                $query = "SELECT showTime, showDay, idMovie,  idRoom FROM " . $this->tableName . ";";
                $this->conecction->GetInstance();
                $result = $this->connection->Execute($query);
                if($result){
                    foreach($result as $value){
                        $newShow = new Show();
                        $newShow->setId($value["id"]);
                        $newShow->setId($value["showTime"]);
                        $newShow->setId($value["showDay"]);
                        $newShow->setId($value["idMovie"]);
                        $newShow->setId($value["idRoom"]);
                        array_push($showList, $newShow);
                    }
                }

            }catch(Exception $ex){
                throw $ex;
                return 0;
            }

            return $showList;
        }
        //Retorna las funciones de una sala en especial
        public function GetShow($idRoom){
            $showList = array();
           try{
               $query = "SELECT showTime, showDay, idMovie,  idRoom FROM " . $this->tableName . " WHERE idRoom = $idRoom;";
               $this->connection = Connection::GetInstance();
               $result = $this->connection->Execute($query);
               if($result){
                   foreach($result as $value){
                       $newShow = new Show();
                       $newShow->setId($value["id"]);
                       $newShow->setTime($value["showTime"]);
                       $newShow->setDay($value["showDay"]);
                       $newShow->setIdMovie($value["idMovie"]);
                       $newShow->setIdRoom($idRoom);
                       array_push($showList, $newShow);
                   }
               }

           }catch(Exception $ex){
               throw $ex;
               return 0;
           }

           return $showList;
       }
    }
?>