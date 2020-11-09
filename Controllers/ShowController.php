<?php
    namespace Controllers;

    use Models\Cinema as Cinema;
    use Models\Room as Room;
    use Models\Show as Show;
    use DAO\RoomDAO as RoomDAO; //ver
    use DAO\CinemaDAO as CinemaDAO;  //ver
    use DAO\MovieDAO as MovieDAO;  //ver
    use DAO\ShowDAO as ShowDAO;
    use DAO\GenresDAO as GenresDAO;

    class ShowController
    {
        private $roomDAO;
        private $cinemaDAO;
        private $showDAO;
        private $movieDAO;
        private $message;
        private $genresDAO;

        public function __construct()
        {
            $this->roomDAO = new RoomDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->showDAO = new ShowDAO();
            $this->movieDAO = new MovieDAO();
            $this->genresDAO = new GenresDAO();
        }
        
        public function Add()
        {
            if ($this->validateDataShow()) {
                $show = new Show();

                if (strpos($_POST["hour"], "a.m.") || strpos($_POST["hour"], "p.m.")) {
                    $hour = substr_replace($_POST["hour"], "", -4);
                    $show->setTime($hour);
                } else {
                    $show->setTime($_POST["hour"]);
                }

                $show->setDay($_POST["date"]);

                $show->setMovie($this->movieDAO->GetMovie($_POST["SelectMovie"]));
                
                $show->setRoom($this->roomDAO->GetRoom($_POST["SelectRoom"]));

                $result = $this->showDAO->Add($show);
                if($result){
                    $message = "La función se agrego correctamente";
                }
                else{
                    $message = "Error en la carga de datos.";
                }
                $this->ShowAddView($message);
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

        public function ShowAddView($message = "")
        {
            $cinemaList = $this->cinemaDAO->GetAll();
            $movieList = $this->movieDAO->GetAll();////ver si es el GetMovieAvailable
       
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
            require_once VIEWS_PATH . "Room-List.php";
        }

        public function Filter()
        {
            if($_POST)
            {
                $date = 0;
                if($_POST["SelectGenre"] <> 0)
                {
                    //filtro por genero
                }

                if (isset($_POST["time"])) {
                    $date = $_POST["time"];
                }
                $this->ShowListView($date);
            }
        }

        public function ShowListView($date)
        {
            $movieList= $this->movieDAO->getMovieAvailable($date);
            $genresList = $this->genresDAO->GetAll();
        
            require_once(VIEWS_PATH . "billboard.php");
        }
    }
