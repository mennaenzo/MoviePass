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

        // Se redirecciona a la vista donde se listan los cines
        public function ShowListView($message = "")
        {
            $message = $this->message;
            $cinemaList = $this->cinemaDAO->GetAll();
            require_once VIEWS_PATH . "Cinema-List.php";
        }

        // Agrega un cine, respetando las validaciones
        public function Add($name, $address)
        {
            if ($this->validateData()) {
                $cinema = new Cinema();
                $cinema->setName($name);
                $cinema->setAddress($address);
          
                $this->message =$this->cinemaDAO->Add($cinema);
                if ($this->message == "Los datos del cine fueron creados correctamente.") {
                    $this->ShowAddRoomView($this->message);
                } else {
                    $this->ShowAddView($this->message);
                }
            } else {
                $this->message = "Al validar los datos ingresados, se produjo un error. Por favor vuelva a ingresarlos.";
                $this->ShowAddView($this->message);
            }
        }

        // Se redirecciona a la vista donde se puede agregar un cine
        public function ShowAddView($message = "")
        {
            $message = $this->message;
            require_once VIEWS_PATH . "cine-add.php";
        }

        // Se redirecciona a la vista para agregar salas a un cine
        public function ShowAddRoomView($message = "")
        {
            $message = $this->message;
              
            require_once VIEWS_PATH . "room-add.php";
        }

        // Validacion de campos en general
        public function validateData()
        {
            if (!empty($_POST)) {
                if ($this->validateField($_POST["cinema_name"]) && $this->validateField(["cinema_address"])) {
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