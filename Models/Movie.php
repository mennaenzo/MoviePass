<?php
    namespace Models;

    class Movie {
        private $id;
        private $adult;
        private $name;
        private $summary;
        private $language;
        private $image;
        private $playingNow;
        private $genres = array();
        private $releaseDate;


        public function getReleaseDate()
        {
            return $this->releaseDate;
        }

        public function setReleaseDate($releaseDate)
        {
            $this->releaseDate = $releaseDate;
        }

        public function setPlayingNow($playingNow){
            $this->playingNow=$playingNow;
        }

        public function getPlayingNow(){
            return $this->playingNow;
        }
/*
        function __construct($id, $adult, $name, $summary, $language,$image,$genres){
            $this->id =  $id;
            $this->adult =  $adult;
            $this->name =  $name;
            $this->summary = $summary;
            $this->language = $language;
            $this->image = $image;
            $this->genres = $genres;
        }
*/
        public function getId(){
            return $this->id;
        }

        public function getImage()
        {
            return $this->image;
        }

        public function setImage($image)
        {
            $this->image = $image;
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