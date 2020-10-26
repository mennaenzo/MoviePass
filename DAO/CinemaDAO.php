<?php
    namespace DAO;
    use DAO\ICinemaDAO as ICinemaDAO;
    use Models\Cinema as Cinema;
    use Models\Room as Room;
    class CinemaDAO implements ICinemaDAO
    {
        private $fileName = "Data/cinema.json";
        private $cinemaList = array();

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

    /*     private function SaveData()
        {
            $arrayToEncode = array();
            foreach($this->cinemaList as $cinema)
            {
                $valuesArray=array();
                $valuesArray["name"] = $cinema->getName();
                $valuesArray["adress"] = $cinema->getAdress();
                $valuesArray["capacity"] = $cinema->getCapacity();
                $valuesArray["ticket_price"] = $cinema->getTicketPrice();
                array_push($arrayToEncode, $valuesArray);
            }
            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

            file_put_contents($this->fileName, $jsonContent);
        } */

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
    }