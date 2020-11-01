<?php
namespace DAO;
use Models\Room as Room;

interface IRoomDAO
{
    function add(Room $room, $idCinema);
    function GetAll();
   // function Delete($id);
    //function Modify(Cinema $cine);
}
?>