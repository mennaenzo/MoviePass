<?php
    namespace Controllers;

    use Models\Cinema as Cinema;
    use Models\Room as Room;
    use DAO\RoomDAO as RoomDAO; //ver 
    use DAO\CinemaDAO as CinemaDAO;  //ver
    use DAO\ShowDAO as ShowDAO;

    class ShowController
    {
        private $roomDAO;
        private $cinemaDAO;
        private $showDAO;
        private $message;

        public function __construct()
        {
            $this->roomDAO = new RoomDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->showDAO = new ShowDAO();
        }
        
        public function Add()
        {
            


        }

        public function addShow(){

            $cinemaList = $this->cinemaDAO->GetAll();
            require_once VIEWS_PATH . "show-add.php";
        }

        public function ShowsList($message ="")
        {       
          
            $showList = $this->showDAO->GetShow($_POST["btnSeeShow"]);
            if($showList != null){
                require_once  VIEWS_PATH . "Show-List.php";
            }  
            else{
                $message = "No hay ninguna funcion disponible para esta sala.";
                $this->ShowRoomView($message);
            }         

        }

        public function ShowRoomView($message = ""){
            
            $roomList = $this->roomDAO->GetAll();
            echo "nada";
           // require_once VIEWS_PATH . "Room-List.php";
        }
    }


?>