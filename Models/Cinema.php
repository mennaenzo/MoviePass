<?php
    namespace Models;

    class Cinema {
        private $id;
        private $name;
        private $capacity;
        private $adress;
        private $ticket_price;
        
        function __construct($id, $name, $capacity, $adress, $ticket_price){
            $this->id = $id;
            $this->name = $name;
            $this->capacity = $capacity;
            $this->adress = $adress;
            $this->ticket_price = $ticket_price;
        }

        public function getId(){
            return $this->id;
        }
        public function setId($id){
            $this->id = $id;
        }

        public function getName(){
            return $this->name;
        }
        public function setName($name){
            $this->name = $name;
        }

        public function getCapacity(){
            return $this->capacity;
        }
        public function setCapacity($capacity){
            $this->capacity = $capacity;
        }

        public function getAdress(){
            return $this->adress;
        }
        public function setAdress($adress){
            $this->adress = $adress;
        }
        
        public function getTicketPrice(){
            return $this->ticket_price;
        }
        public function setTicketPrice($ticket_price){
            $this->ticket_price = $ticket_price;
        }
    }
?>