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
                if($this->validateDayShow($_POST["date"], $_POST["SelectMovie"]))
                {
                    // if(validateTimeShow($_POST["date"], $_POST["hour"]))
                    // {

                    // }
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
                }else{
                    $date = $_POST["date"];
                    $message = "La función ya existe el dia $date";
                    $this->ShowAddView($message);
                } 
            }
        }

        public function validateTimeShow($date, $time)
        {
            // $shows = $this->showDAO->GetShowsByDay($date);
            // echo $time;
            // $hour = substr($time, 0, -3);
            // $minutes = substr($time, 3);
            // echo "<br> $hour <br> $minutes";
            // if($shows <> null)
            // {
            //     foreach($shows as $show)
            //     {
                    
            //     }
            // }else{
            //     return true;
            // }
        }

        public function validateDayShow($date, $idMovie)
        {
            $idShow = $this->showDAO->ExistShowByDay($date, $idMovie);
            if ($idShow == 0)
            {
                return true;
            }else{
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
            if($_POST)
            {
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

        // public function ShowFilter($date, $genre){
        //         $movieList = $this->moviexgenresDAO->GetMoviesByGenreId($_POST["SelectGenre"]);
        //         $genresList = $this->moviexgenresDAO->GetGenresByShows();
        //         require_once (VIEWS_PATH . "billboard.php");
        // }
    }