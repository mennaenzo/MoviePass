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
        require_once(VIEWS_PATH."ticket-view.php");

    }
    public function Add($price, $quantity, $subtotal, $id_show){

        $ticket = new Ticket();
        $ticket->setPrice($price);
        $ticket->setQuantity($quantity);
        $ticket->setSubtotal($subtotal);
        $ticket->setUser($_SESSION['usuarioLogueado']);


        //$show = $this->showDAODB->GetShow($id_show);
        $ticket->setShow($id_show);

        $this->ticketDAO->Add($ticket);

       // $this->ShowPrintView();
    }

    public function ShowTicketView(){
        require_once (VIEWS_PATH . "ticket-view.php");
    }
/*
    PUBLIC function ShowPrintView(){

        $id = $this->ticketDAODB->GetLastId();

        $ticket = new Ticket();
        $ticket=$this->ticketDAODB->GetTicket($id);
        require_once(VIEWS_PATH."ticket-final.php");
    }*/


}