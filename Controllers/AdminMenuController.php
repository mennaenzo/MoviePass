<?php
    namespace Controllers;

    class AdminMenuController{

    public function ShowAddCinemaView(){
        require_once VIEWS_PATH . "cine-add.php";
    }
    
    public function ShowAddRoomView(){
        require_once VIEWS_PATH . "room-add.php";
    }
    }

?>