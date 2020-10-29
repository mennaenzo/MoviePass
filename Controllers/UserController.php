<?php
namespace Controllers;

use DAO\UserDAO as UserDAO;
use Models\User as User;

class UserController
{
    private $userDAO;
    private $message = null;

    public function __construct()
    {
        $this->userDAO = new UserDAO();
    }

    public function ShowAddView($message = "")
    {
        $message = $this->message;
        require_once(VIEWS_PATH . "user-add.php");
    }

    public function ShowListView()
    {
        $userList = $this->userDAO->GetAll();

        require_once(VIEWS_PATH . "user-list.php");
    }

    public function Add($userName, $lastName, $email, $password)
    {
        ////Primero compruebo si existe el usuario que estoy tratando de agregar.
        $userExists = $this->userDAO->SearchUser($email, $password);

        if (!$userExists) {
            /////Si no exite el usuario, creo uno nuevo y lo cargo en la base de datos
            $user = new User();
            $user->setUserName(trim($userName));
            $user->setLastName(trim($lastName));
            $user->setEmail(trim($email));
            $user->setPassword(trim($password));
            $this->userDAO->Add($user);
            $this->message = "Usuario agregado con exito";
            $this->ShowLoginView($this->message);
        } else {
            /////Si el usuario existe, no me lo agrega a la base de datos, me sale el cartel de ya exite dicho usuario
            /// y me lleva a la vista de registrar usuario nuevamente
            $this->message = "El Usuario que intenta registrar ya exite. Registrese con otro Email";
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

            $userExists = $this->userDAO->SearchUser($trimEmail, $trimPassword);

            if ($userExists != null) {
                //guardar en session
                $_SESSION['loggedUser'] = $userExists->getId();


                if ($userExists->getId() == 1 || $userExists->getId() == 2 || $userExists->getId() == 3 || $userExists->getId() == 4) {
                    require_once(VIEWS_PATH . "admin-menu.php");
                }
                else {

                    $this->ShowListView_user();
                }
            } else {
                $this->message = "Usuario no registrado. Registre el Usuario antes de intentar loguearse.";
                $this->ShowLoginView($this->message);
            }
        }
        else{
            $this->message = "Al validar los datos ingresados, se produjo un error. Por favor vuelva a ingresarlos.";
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

    public function validateDataLogin(){
        if(!empty($_POST)){
            if($this->validateField($_POST["email"]) && $this->validateField(["password"])){
                return true;
            }
        }
        else {
            return false;
        }
    }

    public function validateFieldNumber($fieldNumber){

        if($this->validateField($fieldNumber) && is_numeric($fieldNumber) && $fieldNumber > 0 ){
            return true;
        }
        else {
            return false;
        }

    }
    public function validateField($field){
        if(isset($field) && !empty($field)){
            return true;
        }
        else {
            return false;
        }
    }

}
?>