<?php
    namespace DAO;

    use DAO\IRoomDAO as IRoomDAO;
    use DAO\CinemaDAO as CinemaDAO;
    use Models\Cinema as Cinema;
    use Models\Room as Room;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class RoomDAO implements IRoomDAO
    {
        ///private $roomList = array();
        private $connection;
        private $tableName = "Rooms";
        private $cinemaDAO;

        public function __construct(){
            $this->cinemaDAO=new CinemaDAO();
        }

        public function add(Room $room, $idCinema)
        {
            if ($this->validateRoomName($room->getName())) {
                return 0;
            }else {
                try {
                    $query = "INSERT INTO " . $this->tableName . " (roomName, capacity, idCinema, price) VALUES (:roomName, :capacity, :idCinema, :price);";
                    
                    $parameters["roomName"] = $room->getName();
                    $parameters["capacity"] = $room->getCapacity();
                    $parameters["price"] = $room->getRoom_price();
                    $parameters["idCinema"] = $idCinema;
                    
                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query, $parameters);
                    return 1;
                } catch (Exception $ex) {
                    throw $ex;
                    return -1;
                }
            }
        }


        public function validateRoomName($name)
        {
            $flag = false;
            $query = "SELECT roomName FROM ". $this->tableName. " WHERE roomName= '".$name."' and statusRoom=1;";
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);

            if ($result) {
                $flag = true;
            }
            return $flag;
        }


        /* falta validar nombres de salas para un mismo cine
          public function validateNameRoom($name, $nameCinema){
             $this->RetrieveData();
             foreach($this->roomList as $value)){
                 if($name == $value->getName)
             }
         } */

        public function GetAll()
        {
            try{
                $roomList = array();
                $query = "SELECT * FROM " .$this->tableName . " WHERE statusRoom = 1;";
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);

                foreach ($result as $row){
                    $room = new Room();
                    $room->setId($row["id"]);
                    $room->setName($row["roomName"]);
                    $room->setCapacity($row["capacity"]);
                    $cine = $this->cinemaDAO->GetCinema($row["idCinema"]);
                    $room->setRoom_price($row["price"]);
                    array_push($roomList, $room);
                }
                return $roomList;
            }
            catch (Exception $ex){
                throw $ex;
            }
        }

        public function GetRoom($idRoom)
            {
                $room = null;
                try{
                    $query = "SELECT  roomName, capacity, idCinema, price FROM ". $this->tableName." WHERE id=$idRoom;";
                    $this->connection = Connection::GetInstance();
                    $resultSet = $this->connection->Execute($query);

                    foreach ($resultSet as $row){
                        $room = new Room();
                        $room->setId($idRoom);
                        $room->setName($row["roomName"]);
                        $room->setCapacity($row["capacity"]);
                        $room->setNameCinema($this->cinemaDAO->GetCinema($row["idCinema"])->getName());
                        $room->setRoom_price($row["price"]);
                    }
                }
                catch(Exception $ex)
                {
                    throw $ex;
                }

                return $room;
        }

        public function modify($idRoom, $roomName, $capacity, $price){
            try
            {
                $query = "UPDATE " . $this->tableName . " SET roomName= '$roomName', capacity = '$capacity', price = '$price'  WHERE id = '$idRoom';";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
                return true;
            }
            catch(Exception $ex)
            {
                throw $ex;
                return false;
            }
            return $message;
        }

       public function searchRoomsByIdCinema($idCinema)
        {
            $roomList = array();
            try {
                $query = "SELECT id, roomName, price, capacity, idCinema FROM " . $this->tableName . " WHERE idCinema ='".$idCinema."' and statusRoom = 1;";
        
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);
          
                if ($result) {
                    foreach ($result as $value) {
                        $room = new Room();
                        $room->setId($value["id"]);
                        $room->setName($value["roomName"]);
                        $room->setRoom_price($value["price"]);
                        $room->setCapacity($value["capacity"]);
                        $room->setNameCinema($value["idCinema"]); // falta buscar el nombre segun id
                        array_push($roomList, $room);
                    }
                }
            } catch (Exceptio $ex) {
                throw $ex;
            }
            return $roomList;
        }

        public function delete($id){
            try
            {
                $query = "UPDATE " . $this->tableName . " SET statusRoom = 0 WHERE id = $id;";
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query);
                return true;
            }
            catch(Exception $ex)
            {
                throw $ex;
                return false;
            }
        }

        public function checkIfShows($id){
            try{

                $query="Select * from shows s join rooms r on s.idRoom=r.id where r.id=$id;";

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                return $resultSet;
            }
            catch(Exception $ex){
                throw $ex;

            }
        }

        public function checkIfRooms($idCinema){
            try{

                $query="Select * from rooms r where idCinema=$idCinema;";

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                return $resultSet;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }
  
 











/*
        public function RetrieveData()
        {
            try {
                $query = "SELECT id, idCinema, roomName, price, capacity  FROM " . $this->tableName . ";";
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);
                $roomList = array();

                if ($result) {
                    foreach ($result as $value) {
                        $room = new Room();
                        $room->setId($value["id"]);
                        $room->setNameCinema($value["idCinema"]);
                        $room->setName($value["roomName"]);
                        $room->setRoom_price($value["price"]);
                        $room->setCapacity($value["capacity"]);
                        array_push($roomList, $room);
                    }
                }
            } catch (Exception$ex) {
                throw $ex;
            }
        }
        */
 
    
       

        /* Para trabajar con JSON
            private $fileNameRoom = "Data/room.json";

            public function Add(Room $room){
                $this->RetrieveData();
                array_push($this->roomList, $room);
                $this->SaveData();
            }

            public function GetAll(){
                $this->RetrieveData();
                return $this->roomList;
            }

            public function getRoomOfCinema($name){
                $rooms = array();
                $this->RetrieveData();

                foreach ($this->roomList as $room) {

                    if($name == $room->getNameCinema()){
                        array_push($rooms,$room);
                    }
                }
                return $rooms;
            }
            private function SaveData(){
                $arrayToEncode = array();
                foreach($this->roomList as $room)
                {
                    $valuesArray=array();
                    $valuesArray["nameCinema"] = $room->getNameCinema();
                    $valuesArray["name"] = $room->getName();
                    $valuesArray["room_price"] = $room->getRoom_price();
                    $valuesArray["capacity"] = $room->getCapacity();

                    array_push($arrayToEncode, $valuesArray);
                }
                $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

                file_put_contents($this->fileNameRoom, $jsonContent);
            }

            private function RetrieveData(){
                $this->roomList = array();
                if(file_exists($this->fileNameRoom))
                {
                    $jsonContent = file_get_contents($this->fileNameRoom);
                    $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
                    foreach($arrayToDecode as $valuesArray)
                    {
                        $room = new Room();
                        $room->setNameCinema($valuesArray["nameCinema"]);
                        $room->setName($valuesArray["name"]);
                        $room->setRoom_price($valuesArray["room_price"]);
                        $room->setCapacity($valuesArray["capacity"]);
                        array_push($this->roomList, $room);
                    }
                }
            }

         */
}
?>