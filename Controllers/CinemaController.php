<?php


namespace Controllers;
use Models\Cinema as Cinema;

class CinemaController
{
    public function Add(){
        require_once (VIEWS_PATH."index.php");
    }

    public function ShowListView($cinema)
    {

        //$cinemaList = $this->cinemaDAO->GetAll();
        require_once(VIEWS_PATH."Cinema-list.php");
    }

    public function Add($name, $address, $ticketPrice)
    {
        $cinema = new Cinema();
        $cinema->setName($name);
        $cinema->setAddress($address);
        $cinema->setTicketPrice($ticketPrice);
        $this->ShowListView($cinema);
    }



}