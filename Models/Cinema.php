<?php
    namespace Models;

    class Cinema {
        private $id;
        private $name;
        private $address;
        //private $roomList;  hacer get and set

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

        public function setId($id)
        {
            $this->id = $id;
        }
        public function getId()
        {
            return $this->id;
        }

      /*   public function getTicketPrice()
        {
            return $this->ticketPrice;
        }

        
        public function setTicketPrice($ticketPrice)
        {
            $this->ticketPrice = $ticketPrice;
        } */

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