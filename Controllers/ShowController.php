<?php
    namespace Controllers;

    use Models\Cinema as Cinema;
    use Models\Room as Room;
    use Models\Show as Show;
    use DAO\RoomDAO as RoomDAO;
    use DAO\CinemaDAO as CinemaDAO;
    use DAO\MovieDAO as MovieDAO;
    use DAO\ShowDAO as ShowDAO;
    use DAO\GenresDAO as GenresDAO;
    use DAO\MoviesxGenresDAO as MoviesxGenresDAO;

    class ShowController
    {
        private $roomDAO;
        private $cinemaDAO;
        private $showDAO;
        private $movieDAO;
        private $message;
        private $genresDAO;
        private $moviexgenresDAO;

        public function __construct()
        {
            $this->roomDAO = new RoomDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->showDAO = new ShowDAO();
            $this->movieDAO = new MovieDAO();
            $this->genresDAO = new GenresDAO();
            $this->moviexgenresDAO = new MoviesxGenresDAO();
        }
        
        public function Add()
        {
            if ($this->validateDataShow()) {
                $date = $_POST["date"];
                if ($this->validateDayShow($_POST["date"], $_POST["SelectMovie"], $_POST["SelectRoom"])) {
                    if ($this->validateAddShow($_POST["SelectRoom"], $_POST["SelectMovie"], $_POST["date"], $_POST["hour"])) {
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
                        if ($result) {
                            $message = "La función se agrego correctamente";
                        } else {
                            $message = "Error en la carga de datos.";
                        }
                        $this->ShowAddView($message);
                    } else {
                        $message = "La funcion no puede agregarse el dia $date a la hora " . $_POST["hour"];
                        $this->ShowAddView($message);
                    }
                }else{
                    $message = "La función ya existe el dia $date en otro cine.";
                    $this->ShowAddView($message); 
                }
            }
        }

        public function validateDayShow($date, $idMovie, $idRoom)
        {
            $cinema = $this->roomDAO->getCinemaByRoom($idRoom);
            $idShow = $this->showDAO->ExistShowByDay($date, $idMovie, $cinema->getId());

            if ($idShow == 0) {
                return true;
            } else {
                return false;
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
            if ($_POST) {
                $date = 0;
                if ($_POST["date"] <> "") {
                    $date = $_POST["date"];
                }
                $this->ShowListView($date, $_POST["SelectGenre"]);
            }
        }

        public function ShowListView($date, $genre)
        {
            $movieList= $this->movieDAO->getMovieAvailable($date, $genre);
            $genresList = $this->moviexgenresDAO->GetGenresByShows();
            require_once(VIEWS_PATH . "billboard.php");
        }

        public function ShowsView()
        {
            if ($_POST["btnShows"]) {
                $showList = $this->showDAO->GetShowByMovie($_POST["btnShows"]);
                require_once(VIEWS_PATH . "ShowListUser.php");
            }
        }

        private function validateAddShow($idRoom, $idMovie, $date, $startNewMovie)
        {
            $idCinema = $this->roomDAO->getCinemaByRoom($idRoom);

            $showList = $this->showDAO->GetShowsByDay($date);

            $runtime = ($this->movieDAO->GetMovie($idMovie)->getRuntime());
            $format = '+' . ($runtime + 15) . ' minute'; 
            $finishNewMovie = strtotime($format, strtotime($startNewMovie));
            
            // var_dump($showList);

            if ($showList != null) {
                $i = 0;
                foreach ($showList as $value) {

                    $format = '+' . ($value["runtime"] + 15) . ' minute'; 
                    $hourAvailable = strtotime($format, strtotime($value["showTime"]));
                
                    if($hourAvailable <= strtotime($startNewMovie)){ // Hora disp. es menor o igual al comienzo de new movie?
                        if($i+1 > count($showList) - 1) // Es la ultima pelicula?
                        {   
                            //Agrego al final
                            $mod_date = strtotime('+1 day', strtotime($date));
                            $nextDay = date("Y-m-d", $mod_date);
                            return $this->validateAddShow($idRoom, $idMovie, $nextDay, $startNewMovie);
                        }else{
                            // Agrego al medio
                            if($finishNewMovie < strtotime($showList[$i+1]["showTime"])){ // Entra en rango horario?
                                return true;
                            }else{
                                if($i+1 > count($showList) - 1){
                                    return false;
                                }
                            }
                        }
                    }else{ 
                        // Agrego al principio
                        if($finishNewMovie < strtotime($value["showTime"])){ // Entra en rango horario?
                            return true;
                        }else{
                            return false;
                        }
                    }
                    $i++;
                }
            } else {
                return true;
            }
        }

        // function convertMinsToHours($minutes) 
        // {
        //     return date('H:i', mktime(0,$minutes));
        // }

        public function ShowTicketSales()
        {
            $idCine = 0;
            $idMovie = 0;
            $shift = 0;
            
            if($_POST)
            {
                $idCine = $_POST["SelectCine"];
                $idMovie = $_POST["SelectMovie"];
                $shift = isset($_POST["rdBtnShift"]) ? $_POST["rdBtnShift"] : 0;
            }

            $cineList = $this->cinemaDAO->GetAll();
            $movieList= $this->movieDAO->GetAll();

            $showList = $this->showDAO->GetTicketSales($idCine, $idMovie, $shift);
            
            require_once VIEWS_PATH . "ticket-sales.php";
        }

        public function ShowTotalSales()
        {
            $idCine = 0;
            $idMovie = 0;
            $dateSince = date("2020-01-01");
            $dateUntil = date("2025-01-01");
            
            if($_POST)
            {
                $idCine = $_POST["SelectCine"];
                $idMovie = $_POST["SelectMovie"];
                $dateSince = $_POST["dateSince"];
                $dateUntil = $_POST["dateUntil"];
            }
            $cineList = $this->cinemaDAO->GetAll();
            $movieList= $this->movieDAO->GetAll();

            $showList = $this->showDAO->GetTotalSales($idCine, $idMovie, $dateSince, $dateUntil);
            
            require_once VIEWS_PATH . "total-sales.php";
        }
    }
