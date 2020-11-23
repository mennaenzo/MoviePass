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
        $date = $this->showDAO->GetShowById($idShow)->getDay();
        $discount = 0;
        if($this->validateDiscount($date)){
            $discount = ($this->showDAO->GetShowById($idShow)->getRoom()->getRoom_price()) * 0.25;
        }
      
        $price = $this->showDAO->GetShowById($idShow)->getRoom()->getRoom_price();
   
        $ticket->setShow($this->showDAO->GetShowById($idShow));

        $repo = new TicketDAO();
        $ticket->setPrice($price);
        $limit = $repo->GetTotalCapacity($idShow) - $repo->GetReservedAmount($idShow);
        if($limit < 0){
            $limit = 0;
        }
     
       require_once (VIEWS_PATH."add-ticket.php");

    }
    public function Add(){
        if($_POST){
        $ticket = new Tickets();
        $ticket->setPrice($_POST["price"]);
        $ticket->setQuantity($_POST["quantity"]);
        $ticket->setTotal($_POST["total"]);
        $ticket->setUser($_POST["idUser"]);
        $ticket->setShow($_POST["id_show"]);
        $rta = $this->ticketDAO->Add($ticket);
       if($rta == 1) {
           $message = "La compra se realizo con èxito.";
       }else{
            $message = "Se produjo un error. Intente màs tarde.";
        }
      
       $this->ShowTicketsView($message, $_POST["idUser"]);  
     }
     else{
         require_once VIEWS_PATH . "index.php";
     }
    }

    public function ShowTicketsView($message = "", $idUser){

        $ticketList = $this->ticketDAO->GetAllFromUser($idUser);
        $ticketFilter = 
        require_once (VIEWS_PATH . "ticket-list.php");
    }
    

    public function validateDiscount ($date){
        $day = strtotime($date);
        $newDay = date("l", $day);
        if($newDay == "Tuesday" || $newDay == "Wednesday"){
               return true;
            }
        return false;
    } 
        
  /*   public function validateDiscount ($date, $quantity){
        $day = strtotime($date);
        $newDay = date("l", $day);
        if($newDay == "Tuesday" || $newDay == "Wednesday"){
           if($quantity >= 2){
               return true;
           }
        }
        return false;
    } */

  
/*
    PUBLIC function ShowPrintView(){

        $id = $this->ticketDAODB->GetLastId();

        $ticket = new Ticket();
        $ticket=$this->ticketDAODB->GetTicket($id);
        require_once(VIEWS_PATH."ticket-final.php");
    }*/


}