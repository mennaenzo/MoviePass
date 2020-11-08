<?php
    namespace DAO;

    use Models\Show as Show;

    interface IShowDAO
    {
        public function Add(Show $show);
        public function GetAll();
        // function Delete($id);
        //function Modify();
    }
?>
