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
            if($this->validatedata()){
                $newRoom = new Room();
                $newRoom->setNameCinema($this->cinemaDAO->lastLoadedCinema());
                $newRoom->setName($name);
                $newRoom->setRoom_price($room_price);
                $newRoom->setCapacity($capacity);
                $this->roomDAO->add($newRoom, $this->cinemaDAO->searchIdCinemaByName($newRoom->getNameCinema()));
                $this->message = "Carga con exito";
                $this->ShowListCinemaView($this->message);
            }
            else{
                $this->message = "Error en la carga de datos.";
                $this->ShowListCinemaView($this->message);

            }
        }
    
       

        public function ShowListView($message = "")
        {
            $option = $_POST["seeCinemas"];
            if($_POST["btnSeeRoom"] == 1){
                
                $this->ShowListRoomView($option);
            }
            if($_POST["btnSeeRoom"] == 2){
                $this->ShowAddRoomView($option);
            }

        }
       
        public function ShowListCinemaView($message =""){
             $cinemaList = $this->cinemaDAO->GetAll();
            require_once(VIEWS_PATH . "Cinema-List.php");
        }

        public function ShowListRoomView($option){
         
            $roomList = $this->roomDAO->searchRoomsByNameCinema($option, $this->cinemaDAO->searchIdCinemaByName($option));
            require_once VIEWS_PATH . "Room-List.php";
        }

        public function ShowAddRoomView($option){
            require_once VIEWS_PATH . "room-add.php";
        }


        public function DeleteRoom($name){
            echo "delete : ". $name;
        }

          // Validacion de campos en general
          public function validateData(){
            if(!empty($_POST)){
                if($this->validateField($_POST["name"]) && $this->validateFieldNumber($_POST["room_price"]) &&  $this->validateFieldNumber($_POST["number_seats"])){
                   return true;
                }
            }
            else {
                return false;
            }
        }

        // Validacion campos numericos
        public function validateFieldNumber($fieldNumber){
            
            if($this->validateField($fieldNumber) && is_numeric($fieldNumber) && $fieldNumber > 0 ){
                return true;
            }
            else {
                return false;
            }
            
        }
        
        // Validacion de campos (inputs de tipo text)
        public function validateField($field){
            if(isset($field) && !empty($field)){
                return true;
            }
            else {
                return false;
            }
    }
}
?>