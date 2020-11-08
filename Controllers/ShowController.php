<?php
    namespace Controllers;

    use Models\Cinema as Cinema;
    use Models\Room as Room;
    use Models\Show as Show;
    use DAO\RoomDAO as RoomDAO; //ver
    use DAO\CinemaDAO as CinemaDAO;  //ver
    use DAO\MovieDAO as MovieDAO;  //ver
    use DAO\ShowDAO as ShowDAO;

    class ShowController
    {
        private $roomDAO;
        private $cinemaDAO;
        private $showDAO;
        private $movieDAO;
        private $message;

        public function __construct()
        {
            $this->roomDAO = new RoomDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->showDAO = new ShowDAO();
            $this->movieDAO = new MovieDAO();
        }
        
        public function Add()
        {
            if ($this->validateDataShow()) {
                $show = new Show();
                echo "HORA: " . $_POST["hour"];
                if (strpos($_POST["hour"], "a.m.") || strpos($_POST["hour"], "p.m.")) {
                    $hour = substr_replace($_POST["hour"], "", -4);
                    $show->setTime($hour);
                } else {
                    $show->setTime($_POST["hour"]);
                }

                $show->setDay($_POST["date"]);

                $show->setMovie($this->movieDAO->GetMovie($_POST["SelectMovie"]));
                
                $show->setRoom($this->roomDAO->GetRoom($_POST["SelectRoom"]));
                
                $this->showDAO->Add($show);
            }
        }

        public function validateDataShow()
        {
            if (!empty($_POST)) {
                if (UtilitiesController::validateField($_POST["date"])
                    && UtilitiesController::validateField($_POST["hour"])
                    && UtilitiesController::validateField($_POST["SelectMovie"])
                    && UtilitiesController::validateField($_POST["SelectRoom"])) {
                    return true;
                }
            }
            return false;
        }

        public function addShow()
        {
            $cinemaList = $this->cinemaDAO->GetAll();
            $movieList = $this->movieDAO->getMovieAvailable();
       
            require_once VIEWS_PATH . "show-add.php";
        }

        public function ShowsList($message = "")
        {
            $showList = $this->showDAO->GetShow($_POST["btnSeeShow"]);
            if ($showList != null) {
                require_once  VIEWS_PATH . "Show-List.php";
            } else {
                $message = "No hay ninguna funcion disponible para esta sala.";
                $this->ShowRoomView($message);
            }
        }

        public function ShowRoomView($message = "")
        {
            $roomList = $this->roomDAO->GetAll();
            echo "nada";
            // require_once VIEWS_PATH . "Room-List.php";
        }
    }
