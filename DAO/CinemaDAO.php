<?php


    namespace DAO;

    use DAO\ICinemaDAO as ICinemaDAO;
    use Models\Cinema as Cinema;
    use Models\Room as Room;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class CinemaDAO implements ICinemaDAO
    {
        ///private $cinemaList = array();  Comento esta lista para hacer solo las consultas sobre los objetos a la base de datos
        private $connection;
        private $tableName = "Cinemas";  
   
        public function Add(Cinema $cinema)
        {
            if ($this->validateNameCinema($cinema->getName())) {
                if ($this->validateAddressCinema($cinema->getAddress())) {
                    $message = "El cine ya esta registrado.";
                } else {
                    $message = "El cine esta registrado con otra dirección.";
                }
            } elseif ($this->validateAddressCinema($cinema->getAddress())) {
                $message = "La direccion ya esta registrada para otro cine";
            } else {
                try {
                    $query = "INSERT INTO " . $this->tableName . " (cinemaName, address) VALUES (:cinemaName, :address);";
                    $parameters["cinemaName"] = $cinema->getName();
                    $parameters["address"] = $cinema->getAddress();
                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query, $parameters);
                    $message = "Los datos del cine fueron creados correctamente.";
                } catch (Exception $ex) {
                    throw $ex;
                }
            }
            return $message;
        }
    
        
        public function GetAll()
        {
            try{
                $cinemasList = array();
                $query = "SELECT * FROM ".$this->tableName . " WHERE statusCinema=1 order by id desc;";
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);

                foreach ($result as $row){
                    $cinema = new Cinema();
                    $cinema->setId($row["id"]);
                    $cinema->setName($row["cinemaName"]);
                    $cinema->setAddress($row["address"]);
                    array_push($cinemasList, $cinema);
                }
                return $cinemasList;
            }
            catch (Exception $ex){
                throw $ex;
            }
        }
            
        public function searchCinemaByName($name)
        {
            $query = "SELECT id, cinemaName, address FROM " . $this->tableName . " WHERE cinemaName = '".$name."';";
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);
            
            if ($result) {
                foreach ($result as $value) {
                    $cinema = new Cinema();
                    $cinema->setId(($value["id"]));
                    $cinema->setName(($value["cinemaName"]));
                    $cinema->setAddress(($value["address"]));
                }
                return $cinema;
            } else {
                return null;
            }
        }

        public function validateNameCinema($name)
        {
            $flag = false;
            $query = "SELECT cinemaName FROM ". $this->tableName. " WHERE cinemaName= '".$name."' and statusCinema = 1;";
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);

            if ($result) {
                $flag = true;
            }
            return $flag;
        }

        public function validateAddressCinema($address)
        {
            $flag = false;
            $query = "SELECT address FROM ". $this->tableName. " WHERE address = '".$address."' and statusCinema=1;";
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);
           
            if ($result) {
                $flag = true;
            }

            /* $this->RetrieveData();
            $flag = false;
            foreach($this->cinemaList as $value){
                if($address == $value->getAddress()){
                    $flag = true;
                }
            } */
            return $flag;
        }

        public function lastLoadedCinema()
        {
            $cinemaList = array();
            $cinema = new Cinema();
            $cinemaList = $this->GetAll();
            $cinema = (end($cinemaList));
            return $cinema->getname();
        }

        public function GetCinema($id){
            try
            {
                $query = "SELECT * FROM ".$this->tableName." where id=$id;";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                //var_dump($resultSet);
                $cinema = new Cinema();

                foreach ($resultSet as $row){
                    $cinema->setId($row["id"]);
                    $cinema->setName($row["cinemaName"]);
                    $cinema->setAddress($row["address"]);
                }
                return $cinema;
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function delete($id){
            try
            {
                $query = "UPDATE " . $this->tableName . " SET statusCinema = 0 WHERE id = $id;";
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
        public function modify($id, $cinemaName, $address){
            try
            {
                $query = "UPDATE " . $this->tableName . " SET cinemaName = '$cinemaName', address = '$address'  WHERE id = '$id';";
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
    }















/*
            $this->RetrieveData();
            return $this->cinemaList;
            */
        
        /*
        public function RetrieveData()
        {
            try {
                $query = "SELECT * FROM " .  $this->tableName . ";";
                $this->connection = Connection::GetInstance();
             
                $result = $this->connection->Execute($query);
               
                if ($result) {
                    foreach ($result as $value) {
                        $cinema = new Cinema();
                        $cinema->setId($value["id"]);
                        $cinema->setName($value["cinemaName"]);
                        $cinema->setAddress($value["address"]);
                        array_push($this->cinemaList, $cinema);
                    }
                }
            } catch (Exception $ex) {
                throw $ex;
            }
        }
*/



        //PARA TRABAJAR CON JSON
        /*
        private $cinemaList = array();
        private $fileName = "Data/cinema.json";

        public function Add(Cinema $cinema) //sin terminar
        {
            $this->RetrieveData();
            if(!$this->validateNameCinema($cinema->getName())){
                array_push($this->cinemaList, $cinema);
                $this->SaveData();
            }
        }

        public function validateNameCinema($name){
                $this->RetrieveData();
                foreach($this->cinemaList as $value){
                    if($name == $value->getName()){
                        return true;
                    }
                    else {
                        return false;
                    }
                }
        }
        public function GetAll()
        {
            $this->RetrieveData();
            return $this->cinemaList;
        }

        private function SaveData()
        {
            $arrayToEncode = array();
            foreach($this->cinemaList as $cinema)
            {
                $valuesArray=array();
                $valuesArray["id"] = $cinema->getId();
                $valuesArray["name"] = $cinema->getName();
                $valuesArray["address"] = $cinema->getAddress();
               // $valuesArray["room"] = $cinema->getRoom();

                array_push($arrayToEncode, $valuesArray);
            }
            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $jsonContent);
        }

        public function Delete($name){
            $this->RetrieveData();
            $newList = array();
            foreach ($this->cinemaList as $cinema) {
                if($cinema->getName() != $name){
                    array_push($newList, $cinema);
                }
            }

            $this->cinemaList = $newList;
            $this->saveData();
        }

        private function RetrieveData()
        {
            $this->cinemaList = array();
            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();
                foreach($arrayToDecode as $valuesArray)
                {
                    $cinema = new Cinema();
                    $cinema->setId($valuesArray["id"]);
                    $cinema->setName($valuesArray["name"]);
                    $cinema->setAddress($valuesArray["address"]);
                   // $cinema->setTicketPrice($valuesArray["ticket_price"]);
                    array_push($this->cinemaList, $cinema);
                }
            }
        }

        public function lastLoadedCinema(){
            $cinema = new Cinema();
            $this->RetrieveData();
          //var_dump ($this->cinemaList);
           $cinema =( end($this->cinemaList));
           return $cinema->getname();
        }
    } */
?>