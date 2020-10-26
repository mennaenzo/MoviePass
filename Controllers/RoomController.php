<?php
    namespace Controllers;
    use Models\Cinema as Cinema;
    use Models\Room as Room;
    use DAO\RoomDAO as RoomDAO;
    use DAO\CinemaDAO as CinemaDAO;

    class RoomController{

        private $roomDAO;
        private $cinemaDAO;
        private $message;

        public function __construct()
        {
            $this->roomDAO = new RoomDAO();
            $this->cinemaDAO = new CinemaDAO();
        }
        
        public function addRoom($name, $room_price, $capacity){
            $newRoom = new Room();
            if(isset($_POST["button"])){
                echo $_POST["button"];
                $newRoom->setNameCinema($_POST["button"]);
                $newRoom->setName($name);
                $newRoom->setRoom_price($room_price);
                $newRoom->setCapacity($capacity);
            }
            else{
                $newRoom->setNameCinema($this->cinemaDAO->lastLoadedCinema());
                $newRoom->setName($name);
                $newRoom->setRoom_price($room_price);
                $newRoom->setCapacity($capacity);
            }
            $this->roomDAO->Add($newRoom);
            $this->message = "Carga con exito";
            $this->ShowListCinemaView($this->message);
        }
       

        public function ShowListView($message = "")
        {
            
            $roomList = new Room();
            $message = $this->message;     
            // $roomList = $this->roomDAO->getRoomOfCinema($this->cinemaDAO->lastLoadedCinema());
            $roomList = $this->roomDAO->getRoomOfCinema($_POST["seeCinemas"]);
            //$cinemaList = $this->cinemaDAO->GetAll();
            require_once(VIEWS_PATH . "Room-List.php");
        }
       
        public function ShowListCinemaView($message =""){
            $cinemaList = $this->cinemaDAO->GetAll();
            require_once( VIEWS_PATH . "Cinema-List.php");
        }

        public function DeleteRoom($name){
            echo "name : ". $name;
        }
    }
?>