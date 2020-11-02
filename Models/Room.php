<?php 
    namespace Models;

    class Room {
        private $id; 
        private $cinemaName;
        private $name;
        private $room_price;
        private $capacity;

       /*  function __construct($name, $room_price, $capacity){
            $this->name = $name;
            $this->room_price = $room_price;
            $this->capacity = $capacity;
        } */

        public function getName(){
            return $this->name;
        }
        public function setName($name){
            $this->name = $name;
        }

        public function getNameCinema(){
            return $this->cinemaName;
        }
        public function setNameCinema($nameCinema){
            $this->cinemaName = $nameCinema;
        }
    
        public function getRoom_price(){
            return $this->room_price;
        }
        public function setRoom_price($room_price){
            $this->room_price = $room_price;
        }
    
        public function getCapacity(){
            return $this->capacity;
        }
        public function setCapacity($capacity){
            $this->capacity = $capacity;
        }
        public function setId($id){
            $this->id = $id;
        }
        public function getId(){
            return $this->id;
        }
    }
?>