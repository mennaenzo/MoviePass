<?php
    namespace Controllers;

    use DAO\CinemaDAO as CinemaDAO;
    use DAO\MovieDAO as MovieDAO;
    use DAO\UserDAO as UserDAO;
    use DAO\GenresDAO as GenresDAO;
    use DAO\TicketDAO as TicketDAO;
    use DAO\MoviesxGenresDAO as MoviesxGenresDAO;
    use Models\User as User;


    class UserController
    {
        private $userDAO;
        private $genresDAO;
        private $cinemaDAO;
        private $movieDAO;
        private $ticketDAO;
        private $moviexGenresDAO;
        private $message = null;

        public function __construct()
        {
            $this->movieDAO = new MovieDAO();
            $this->moviexGenresDAO = new MoviesxGenresDAO();
            $this->userDAO = new UserDAO();
            $this->cinemaDAO = new CinemaDAO();
            $this->genresDAO = new GenresDAO();
            $this->ticketDAO = new ticketDAO();
        }

        public function ShowAddView($message = "")
        {
            $message = $this->message;
            require_once(VIEWS_PATH . "user-add.php");
        }

        public function ShowMovieListAdmin(){
            $movieList = $this->movieDAO->GetAll();
            $genresList = $this->genresDAO->GetAll();
            require_once(VIEWS_PATH . "admin-menu.php");
        }

        public function ShowListView()
        {
            $userList = $this->userDAO->GetAll();

            require_once(VIEWS_PATH . "user-list.php");
        }

        public function Add($userName, $lastName, $email, $userPassword)
        {
            ////Primero compruebo si existe el usuario que estoy tratando de agregar.
            $userExists = $this->userDAO->SearchUser($email);

            if (!$userExists) {
                /////Si no exite el usuario, creo uno nuevo y lo cargo en la base de datos
                $user = new User();
                $user->setUserName(trim($userName));
                $user->setLastName(trim($lastName));
                $user->setEmail(trim($email));
                $user->setUserPassword(trim($userPassword));
                //$user->setEsAdmin();
                $this->userDAO->Add($user);
                $this->message = "Usuario agregado con exito.";
                $this->ShowLoginView($this->message);
            } else {
                /////Si el usuario existe, no me lo agrega a la base de datos, me sale el cartel de ya exite dicho usuario
                /// y me lleva a la vista de registrar usuario nuevamente
                $this->message = "Ya existe un usuario registrado con: $email";
                $this->ShowRegisterView($this->message);
            }
        }

        public function ShowLoginView($message = "")
        {
            $message = $this->message;
            require_once(VIEWS_PATH . "index.php");
        }

        public function ShowRegisterView($message = "")
        {
            $message = $this->message;
            require_once(VIEWS_PATH . "registerView.php");
        }


        public function Login($email, $password)
        {
            if ($this->validateDataLogin()) {
                ////quito espacios del email
                $trimEmail = trim($email);
                $trimPassword = trim($password);

                $userExists = $this->userDAO->SearchUser($trimEmail);
                
                if ($userExists != null) {
                    if ($userExists->getUserPassword() == $password) {
                        //guardar en session
                        $_SESSION['loggedUser'] = $userExists->getId();

                        //cambiar ----------------------------
                        if ($userExists->getEsAdmin() == 1) {
                            $this->ShowMovieListAdmin();
                        } else {
                            $this->ShowListView_user();
                        }
                    } else {
                        $this->message = "Contraseña incorrecta.";
                        $this->ShowLoginView($this->message);
                    }
                }else{
                    $this->message = "Usuario no registrado.";
                    $this->ShowLoginView($this->message);
                }
            }else{
                $this->message = "Error de datos.";
                $this->ShowLoginView($this->message);
            }
        }

        public function SearchUser($email)
        {
            $userList = $this->userDAO->GetAll();
            foreach ($userList as $user) {
                if ($user->getEmail() == $email) {
                    return true;
                }
            }
            return false;
        }

        public function validateDataLogin()
        {
            if (!empty($_POST)) {
                if ($this->validateField($_POST["email"]) && $this->validateField(["password"])) {
                    return true;
                }
            }
            return false;
        }

        public function validateFieldNumber($fieldNumber)
        {
            if ($this->validateField($fieldNumber) && is_numeric($fieldNumber) && $fieldNumber > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function validateField($field)
        {
            if (isset($field) && !empty($field)) {
                return true;
            } else {
                return false;
            }
        }

        public function Logout()
        {
            session_destroy();
            //require_once(VIEWS_PATH."index.php");
            $this->ShowLoginView();
        }

        public function ShowListView_user()
        {
            // $movieList = $this->movieDAO->getMoviesFromShows();
            // $genresList = $this->moviesxGenresDAO->GetGenresByShows();
            // //var_dump($movieList);
            // require_once VIEWS_PATH . "billboard.php";

            $movieList= $this->movieDAO->getMovieAvailable();
            $genresList = $this->moviexGenresDAO->GetGenresByShows();
            require_once(VIEWS_PATH . "billboard.php");
        }


        public function ShowListViewCinema_user()
        {
            $cinemaList = $this->cinemaDAO->GetAll();
            require_once(VIEWS_PATH."cinema-list-user.php");
        }


        public function InviteUser(){
            if($_POST){
                $inviteUser = $_POST["inviteButton"];
                $_SESSION['inviteUser'] = $inviteUser;
                $this->ShowListView_user();
            }

        }

        public function ShowTicketsFromUser()
        {
            $ticketList = $this->ticketDAO->GetAllFromUser($_SESSION['loggedUser']);
            $ticketFilter = $this->ticketDAO->GetMovieNameList($_SESSION['loggedUser']);
            
           require_once (VIEWS_PATH . "ticket-list.php");
            
        }

    }
