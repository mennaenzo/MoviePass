<?php 
    namespace Models;

    class Tickets {

        private $id;
        private $price; 
        private $show;
        private $user;
        private $quantity;
        private $total;

        public function getId(){
            return $this->id;
        }
    
        public function setId($id){
            $this->id = $id;
        }
    
        public function getPrice(){
            return $this->price;
        }
    
        public function setPrice($price){
            $this->price = $price;
        }
    
        public function getShow(){
            return $this->show;
        }
    
        public function setShow($show){
            $this->show = $show;
        }
    
        public function getUser(){
            return $this->user;
        }
    
        public function setUser($user){
            $this->user = $user;
        }
    
        public function getQuantity(){
            return $this->quantity;
        }
    
        public function setQuantity($quantity){
            $this->quantity = $quantity;
        }
    
        public function getTotal(){
            return $this->total;
        }
    
        public function setTotal($total){
            $this->total = $total;
        }
    }
?>