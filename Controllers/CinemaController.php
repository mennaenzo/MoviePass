<?php

    namespace Controllers;

    use Models\Cinema as Cinema;
    use DAO\CinemaDAO as CinemaDAO;
    use DAO\RoomDAO as RoomDAO;

    class CinemaController
    {
        private $cinemaDAO;
        private $message;

        public function __construct()
        {
            $this->cinemaDAO = new CinemaDAO();
            $this->roomDAO = new RoomDAO();
        }

        public function ShowListView($message = "")
        {
            $message = $this->message;
            $cinemaList = $this->cinemaDAO->GetAll();
            //$roomList = $this->roomDAO->GetAll();
            require_once(VIEWS_PATH . "cinema-list.php");
        }

        public function Add($name, $address)
        {
            if($this->validateData()){
                $cinema = new Cinema();
                $cinema->setName($name);
                $cinema->setAddress($address);
                //$cinema->setTicketPrice($ticketPrice);
          
                $this->cinemaDAO->Add($cinema);
                $this->message = "Los datos del cine fueron cargados correctamente.";
                //array_push($this->cinemaList, $cinema);

                $this->ShowAddRoomView($this->message);
              
                //$this->ShowListView($this->message);
            }
            else {
                $this->message = "Al validar los datos ingresados, se produjo un error. Por favor vuelva a ingresarlos.";
                $this->ShowAddView($this->message);
            }
        }

        public function ShowAddView($message = "")
        {
            $message = $this->message;
            require_once VIEWS_PATH . "cine-add.php";
        }

        public function ShowAddRoomView($message = ""){
                $message = $this->message;
              
                require_once VIEWS_PATH . "room-add.php";
        }

        public function validateData(){
            if(!empty($_POST)){
                if($this->validateField($_POST["cinema_name"]) && $this->validateField(["cinema_address"])){
                    return true;
                 /*  if($this->validateFieldNumber($_POST["ticket_price"]) && $this->validateFieldNumber($_POST["number_room"]) && $this->validateFieldNumber($_POST["number_seats"])){
                        return true;
                    } */
                }
            }
            else {
                return false;
            }
        }

        public function validateFieldNumber($fieldNumber){
            
            if($this->validateField($fieldNumber) && is_numeric($fieldNumber) && $fieldNumber > 0 ){
                return true;
            }
            else {
                return false;
            }
            
        }
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