<?php
    namespace Models;

    class Show
    {
        private $id;
        private $time;
        private $day;
        private $movie;
        private $room;
    
        public function getId()
        {
            return $this->id;
        }
        public function setId($id)
        {
            $this->id = $id;
        }

        public function getTime()
        {
            return $this->time;
        }
        public function setTime($time)
        {
            $this->time = $time;
        }
        public function getDay()
        {
            return $this->day;
        }

        public function setDay($day)
        {
            $this->day = $day;
        }
        public function getMovie()
        {
            return $this->movie;
        }

        public function setMovie($movie)
        {
            $this->movie = $movie;
        }
    
        public function getRoom()
        {
            return $this->room;
        }
        public function setRoom($room)
        {
            $this->room = $room;
        }
    }
?>