<?php


namespace Controllers;
use Models\Tickets as Tickets;
use DAO\ShowDAO as ShowDAO;
use DAO\TicketDAO as TicketDAO;

class TicketController
{
    private $ticketDAO;
    private $showDAO;


    public function __construct()
    {
        $this->showDAO = new ShowDAO();
        $this->ticketDAO = new TicketDAO();

    }

    public function TicketToBuy($idShow)
    {
        $ticket = new Tickets();
        $price = $this->showDAO->GetShowById($idShow)->getRoom()->getRoom_price();
   
        $ticket->setShow($this->showDAO->GetShowById($idShow));

        $repo = new TicketDAO();
        $ticket->setPrice($price);
        $limit = $repo->GetTotalCapacity($idShow) - $repo->GetReservedAmount($idShow);
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
           $message = "La compra se realizo con exito.";
       }else{

           }
       }

       // $this->ShowPrintView();


    public function ShowTicketView(){

        require_once (VIEWS_PATH . "add-ticket.php");
    }

/*
    PUBLIC function ShowPrintView(){

        $id = $this->ticketDAODB->GetLastId();

        $ticket = new Ticket();
        $ticket=$this->ticketDAODB->GetTicket($id);
        require_once(VIEWS_PATH."ticket-final.php");
    }*/


}