<?php


    namespace DAO;

    use DAO\ICinemaDAO as ICinemaDAO;
    use Models\Cinema as Cinema;
    use Models\Room as Room;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class CinemaDAO implements ICinemaDAO
    {
        private $cinemaList = array();
        private $connection;
        private $tableName = "Cinemas";   //Observación: ver si en la base de datos tiene  que ir "cinemas" ( en plural)
   
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
            // return $this->RetrieveData();
            return $this->cinemaList;
        }
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

        public function searchIdCinemaByName($name)
        {
            $query = "SELECT id FROM " . $this->tableName . " WHERE cinemaName = '".$name."';";
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);
            
            if ($result) {
                foreach ($result as $value) {
                    $cinema = new Cinema();
                    $cinema->setId(($value["id"]));
                }
                return $cinema->getId();
            } else {
                return null;
            }
        }

        public function validateNameCinema($name)
        {
            $flag = false;
            $query = "SELECT cinemaName FROM ". $this->tableName. " WHERE cinemaName= '".$name."';";
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);

            if ($result) {
                $flag = true;
            }
            /*  $this->RetrieveData();
             $flag = false;
             foreach($this->cinemaList as $value){
                 if($name == $value->getName()){
                    $flag = true;
                 }
             } */
            return $flag;
        }

        public function validateAddressCinema($address)
        {
            $flag = false;
            $query = "SELECT address FROM ". $this->tableName. " WHERE address = '".$address."';";
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
            $cinema = new Cinema();
            $this->RetrieveData();
            $cinema = (end($this->cinemaList));
            return $cinema->getname();
        }
    }



















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