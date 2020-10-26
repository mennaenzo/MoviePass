<?php
namespace DAO;
use Models\Room as Room;

class RoomDAO{

    private $roomList = array();
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
            /* echo $name . " = " . $room->getNameCinema() . "<br>";
            echo $room->getNameCinema() . "->" . gettype($room->getNameCinema());
            echo " = ". $name.  "-> " . gettype($name) . "<br>";   */
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
            // $valuesArray["room"] = $cinema->getRoom();
            
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

        
}
?>