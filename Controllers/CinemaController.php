<?php

    namespace Controllers;

    use Models\Cinema as Cinema;
    use DAO\CinemaDAO as CinemaDAO;

    class CinemaController
    {
        private $cinemaDAO;

        public function __construct()
        {
            $this->cinemaDAO = new CinemaDAO();
        }

        public function ShowListView()
        {
            $cinemaList = $this->cinemaDAO->GetAll();
            require_once(VIEWS_PATH . "cinema-list.php");
        }

        public function Add($name, $address, $ticketPrice)
        {
            $cinema = new Cinema();
            $cinema->setName($name);
            $cinema->setAddress($address);
            $cinema->setTicketPrice($ticketPrice);
            
            $this->cinemaDAO->Add($cinema);

            //array_push($this->cinemaList, $cinema);

            $this->ShowListView();
        }

        public function ShowAddView()
        {
            require_once VIEWS_PATH . "cine-add.php";
        }
    }
?>