<?php


namespace Controllers;
use Models\Tickets as Tickets;

use DAO\TicketDAO as TicketDAO;
use DAO\CinemaDAO as CinemaDAO;
use DAO\MovieDAO as MovieDAO;
use DAO\RoomDAO as RoomDAO;
use DAO\ShowDAO as ShowDAO;

class TicketController
{
    private $ticketDAO;
    private $showDAO;


    public function __construct()
    {
        $this->showDAO = new ShowDAO();
        $this->ticketDAO = new TicketDAO();
        $this->roomDAO=new RoomDAO();
        $this->cinemaDAO=new CinemaDAO();

    }

    public function TicketToBuy($idShow)
    {
        $ticket = new Tickets();
        $price = $this->showDAO->GetShowById($idShow)->getRoom()->getRoom_price();
   
        $ticket->setShow($this->showDAO->GetShowById($idShow));

        $repo = new TicketDAO();
        $ticket->setPrice($price);
        $limit = $repo->GetTotalCapacity($idShow) - $repo->GetReservedAmount($idShow);
        if($limit < 0){
            $limit = 0;
        }
        require_once(VIEWS_PATH."add-ticket.php");

    }
    public function Add($price, $quantity, $total, $id_show, $idUser){

        $ticket = new Tickets();
        $ticket->setPrice($price);
        $ticket->setQuantity($quantity);
        $ticket->setTotal($total);
        $ticket->setUser($idUser);
        $ticket->setShow($id_show);
        $rta = $this->ticketDAO->Add($ticket);
       if($rta == 1) {
           $message = "La compra se realizo con èxito.";
       }else{
            $message = "Se produjo un error, intente màs tarde..";
           }
       
        
       $this->ShowTicketsView($message, $idUser);
    }

    public function ShowTicketsView($message = "", $idUser){

        $ticketList = $this->ticketDAO->GetAllFromUser($idUser);

        require_once (VIEWS_PATH . "ticket-list.php");
    }

/*
    PUBLIC function ShowPrintView(){

        $id = $this->ticketDAODB->GetLastId();

        $ticket = new Ticket();
        $ticket=$this->ticketDAODB->GetTicket($id);
        require_once(VIEWS_PATH."ticket-final.php");
    }*/


}