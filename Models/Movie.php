<?php
    namespace Models;

    class Movie {
        private $id;
        private $adult;
        private $name;
        private $summary;
        private $language;
        private $genres = array();


        function __construct($id, $adult, $name, $summary, $language,$genres){
            $this->id =  $id;
            $this->adult =  $adult;
            $this->name =  $name;
            $this->summary = $summary;
            $this->language = $language;
            $this->genres = $genres;
        }

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getAdult(){
            return $this->adult;
        }

        public function setAdult($adult){
            $this->adult = $adult;
        }

        public function getName(){
            return $this->name;
        }

        public function setName($name){
            $this->name = $name;
        }

        public function getSummary(){
            return $this->summary;
        }

        public function setSummary($summary){
            $this->summary = $summary;
        }

        public function getLanguage(){
            return $this->language;
        }

        public function setLanguage($language){
            $this->language = $language;
        }

        public function getGenres(){
            return $this->genres;
        }

        public function setGenres($genres){
            $this->genres = $genres;
        }
    }
?>