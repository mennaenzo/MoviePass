<?php
    namespace Models;

    class Cinema {
        private $id;
        private $name;
       //private $capacity;  La capacidad pertenece a la sala, no al cine
        private $address;
        private $ticketPrice;

        /**
         * @return mixed
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * @param mixed $name
         */
        public function setName($name)
        {
            $this->name = $name;
        }

        /**
         * @return mixed
         */
        public function getAddress()
        {
            return $this->address;
        }

        /**
         * @param mixed $address
         */
        public function setAddress($address)
        {
            $this->address = $address;
        }

        /**
         * @return mixed
         */
        public function getTicketPrice()
        {
            return $this->ticketPrice;
        }

        /**
         * @param mixed $ticketPrice
         */
        public function setTicketPrice($ticketPrice)
        {
            $this->ticketPrice = $ticketPrice;
        }

        /*
        function __construct( $name, $adress, $ticketPrice){
            //$this->id = $id;
            $this->name = $name;
        //  $this->capacity = $capacity;
            $this->adress = $adress;
            $this->ticketPrice = $ticketPrice;
        }*/


        /*
        public function getCapacity(){
            return $this->capacity;
        }
        public function setCapacity($capacity){
            $this->capacity = $capacity;
        }*/
    }
?>