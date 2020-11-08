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
                    $cinemaAdd = $this->cinemaDAO->searchCinemaByName($cinema->getName()); //BUSCO EL ID DEL CINEMA AGREGADO PARA DESPUES PODER MOSTRAR SU NOMBRE 
                    $this->ShowAddRoomView($this->message, $cinemaAdd);
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

        public function ShowModifyView()
        {
            $cinema = $this->cinemaDAO->GetCinema($_POST["btnModify"]);
            if(isset($cinema)){
               require_once VIEWS_PATH . "modifyCine.php";
            } 
            else{
                $message = "El cine que se quiere modificar no existe.";
                $this->ShowListView();
            }
     
        }

        // Se redirecciona a la vista para agregar salas a un cine
        public function ShowAddRoomView($message = "", Cinema $cinemaAdd)
        {
            $message = $this->message;
            $cinemaList = $this->cinemaDAO->GetAll(); 
            require_once VIEWS_PATH . "room-add-admin.php";
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

        public function delete(){
            if($_POST["btnRemove"] != null){
                if($this->cinemaDAO->delete($_POST["btnRemove"])){
                    $message = "El cine se dio de baja correctamente.";
                }
                else{
                    $message = "El cine no se dio de baja.";
                } 
                $this->ShowListView($message);
            }
        }

        public function modify(){
            if($_POST["btnModify"]){
               if($this->cinemaDAO->modify($_POST["btnModify"], $_POST["name"], $_POST["address"])){
                    $message = "El cine se modifico correctamente.";
               }
               else{
                    $message = "El cine no se pudo modificar";
               }
                $this->ShowListView($message);
            }
        }
    }
?>