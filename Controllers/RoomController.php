<?php
    namespace Controllers;

    use Models\Cinema as Cinema;
    use Models\Room as Room;
    use DAO\RoomDAO as RoomDAO;
    use DAO\CinemaDAO as CinemaDAO;

    class RoomController
    {
        private $roomDAO;
        private $cinemaDAO;
        private $message;

        public function __construct()
        {
            $this->roomDAO = new RoomDAO();
            $this->cinemaDAO = new CinemaDAO();
        }
        
        public function addRoom()
        {
            if($_POST["comboBox"]){
                $cinemaId = $_POST["comboBox"];
                if ($this->validatedata()) {
                    $newRoom = new Room();
                    $newRoom->setNameCinema($this->cinemaDAO->GetCinema($cinemaId)->getName());
                    $newRoom->setName($_POST["name"]);
                    $newRoom->setRoom_price($_POST["room_price"]);
                    $newRoom->setCapacity($_POST["capacity"]);
                    $status = $this->roomDAO->add($newRoom, $cinemaId);
            
                    if ($status <> 0) {
                        if($status)
                        {
                            $message = "Agregado correctamente";
                            $this->ShowListCinemaView($message);
                        }else{
                            $message = "La sala ya existe";
                            $this->ShowAddRoom($message);
                        }
                    }else{
                        $message = "Error de conexion. Pongase en contacto con su proveedor.";
                        $this->ShowAddRoom($message);
                    }
                } else {
                    $message = "Error en la carga de datos.";
                    $this->ShowListCinemaView($message);
                }
            
            }
        }
    
/*
        public function ShowListView($message = "")
        {
            $option = $_POST["select"];
            if ($_POST["btnSeeRoom"] == 1) {
                $this->ShowListRoomView($option);
            }
            if ($_POST["btnSeeRoom"] == 2) {
                $this->ShowAddRoomView($option);
            }
        }
       */
        public function ShowListCinemaView($message ="")
        {
            $cinemaList = $this->cinemaDAO->GetAll();
            require_once  VIEWS_PATH . "Cinema-List.php";
        }

        public function ShowListRoomView()
        { 
            if($_POST["btnSeeRoom"]){
                $roomList = $this->roomDAO->searchRoomsByIdCinema($_POST["btnSeeRoom"]);
                require_once VIEWS_PATH . "Room-List.php";
            } 
        }

        public function ShowRoomListView_User($id)
        {
            $roomList = $this->roomDAO->searchRoomsByIdCinema($id);
            require_once VIEWS_PATH . "room-list-user.php";
        }

       /*  public function ShowAddRoomView($option)
        {
            require_once VIEWS_PATH . "room-add.php";
        } */

        public function ShowAddRoom($message = ''){
            ///$message = $this->message;
            $cinemaList = $this->cinemaDAO->GetAll();
            $cinemaAdd = new Cinema();
            require_once VIEWS_PATH . "room-add-admin.php";
        }

        public function cancelRoom(){
            echo "'BORRAR CINE";
        }

        public function delete($name)
        {
            echo "'BORRAR Sala";
        }

        public function ShowModifyView()
        {
            $room = $this->roomDAO->GetRoom($_POST["btnModify"]);
            if(isset($room)){
               require_once VIEWS_PATH . "modifyRoom.php";
            } 
            else{
                $message = "La sala que se quiere modificar no existe.";
                $this->ShowListCinemaView($message);
            }
     
        }

        public function modify(){
            if($_POST["btnModify"]){
                if($this->roomDAO->modify($_POST["btnModify"], $_POST["name"],$_POST["capacity"], $_POST["room_price"])){
                    $message = "La sala se pudo modificar";
                }
                else{
                    $message = "La sala no se pudo modificar";
                }
                $this->ShowListCinemaView($message);
            }
        }

        // Validacion de campos en general
        public function validateData()
        {
            if (!empty($_POST)) {
                if ($this->validateField($_POST["name"]) && $this->validateFieldNumber($_POST["room_price"]) &&  $this->validateFieldNumber($_POST["capacity"])) {
                    return true;
                }
            } else {
                return false;
            }
        }

        // Validacion campos numericos
        public function validateFieldNumber($fieldNumber)
        {
            if ($this->validateField($fieldNumber) && is_numeric($fieldNumber) && $fieldNumber > 0) {
                return true;
            } else {
                return false;
            }
        }
        
        // Validacion de campos (inputs de tipo text)
        public function validateField($field)
        {
            if (isset($field) && !empty($field)) {
                return true;
            } else {
                return false;
            }
        }
    }
?>