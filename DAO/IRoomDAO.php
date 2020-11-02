<?php
    namespace DAO;

    use Models\Room as Room;

    interface IRoomDAO
    {
        public function add(Room $room, $idCinema);
        public function GetAll();
        // function Delete($id);
        //function Modify(Cinema $cine);
    }
