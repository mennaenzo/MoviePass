<?php
    namespace Controllers;

    use DAO\UserDAO as UserDAO;
    use Models\User as User;

    class UserController
    {
        private $userDAO;
        private $message;

        public function __construct()
        {
            $this->userDAO = new UserDAO();
        }

        public function ShowAddView($message = "")
        {
            $message = $this->message;
            require_once(VIEWS_PATH."user-add.php");
        }

        public function ShowListView()
        {
            $userList = $this->userDAO->GetAll();

            require_once(VIEWS_PATH."user-list.php");
        }

        public function Add($name, $lastName, $email, $password)
        {
            $this->message = "Usuario agregado con exito";
            $user = new User();
            $user->setName($name);
            $user->setLastName($lastName);
            $user->setEmail($email);
            $user->setPassword($password);
            $this->userDAO->Add($user);

            $this->ShowLoginView($this->message);
        }

        public function ShowLoginView($message = "")
        {
            $message = $this->message;
            require_once(VIEWS_PATH."index.php");
        }

        public function ShowRegisterView($message = "")
        {
            $message = $this->message;
            require_once(VIEWS_PATH."registerView.php");
        }

        public function Login ($email, $password){
            $userExists = $this->userDAO->SearchUser($email,$password);

            if($userExists != null){
                //guardar en session
                $_SESSION['userLogged'] = $userExists->getId();

                $enzo = "enzo@moviepass.com";
                $martin = "martin@moviepass.com";
                $federico = "federico@moviepass.com";
                $fabian = "fabian@moviepass.com";

                if($userExists->getEmail() == $enzo || $userExists->getEmail() == $martin || $userExists->getEmail() == $federico || $userExists->getEmail() == $fabian   )
                {
                    require_once(VIEWS_PATH."admin-menu.php");
                }

                else{

                    $this->ShowListView_user();
                }
            }
            else{
                $this->message = "Usuario no registrado";
                $this->ShowLoginView($this->message);
            }
        }

        public function SearchUser($email, $password){
            $userList = $this->userDAO->GetAll();
            foreach ($userList as $user){
                if($user->getEmail() == $email && $user->getPassword() == $password){
                    return true;
                }
            }
            return false;
        }

    }
?>