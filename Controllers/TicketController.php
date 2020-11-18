<?php


namespace Controllers;
use Models\Ticket as Ticket;
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

    public function TicketToBuy($id_show)
    {
        $ticket = new Ticket();
        $price = $this->showDAO->GetShow($id_show)->getRoom()->getRoom_price();

        $ticket->setShow($this->showDAO->GetShow($id_show));

        $ticket->setPrice($price);

        require_once(VIEWS_PATH."ticket-view.php");

    }
    public function Add($price, $quantity, $subtotal, $id_show){

        $ticket = new Ticket();
        $ticket->setPrice($price);
        $ticket->setQuantity($quantity);
        $ticket->setSubtotal($subtotal);
        $ticket->setUser($_SESSION['usuarioLogueado']);


        $show = $this->showDAODB->GetShow($id_show);
        $ticket->setShow($show);

        $this->ticketDAODB->Add($ticket);

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