<?php
    namespace DAO;

    use Models\Cinema as Cinema;

    interface ICinemaDAO
    {
        public function Add(Cinema $cinema);
        public function GetAll();
        // function Delete($id);
        //function Modify(Cinema $cine);
    }
?>

