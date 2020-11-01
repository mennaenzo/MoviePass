<?php
    namespace DAO;
    
    use Models\Movie as Movie;

    class MovieDAO{

        private $moviesList = array();

        public function Add(Movie $movie)
        {
            array_push($this->moviesList, $movie);
        }

        public function GetAll()
        {
            $this->getNowPlaying();
            return $this->moviesList;
        }

        public function getNowPlaying()
        {
            $object = json_decode(file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=" . KEY . "&language=es&page=1"), FALSE);
            //var_dump($object);
            foreach($object->results as $movie)
            {
                $newMovie = new Movie($movie->id, $movie->adult, $movie->title, $movie->overview, $movie->original_language, $movie->genre_ids);
                
                array_push($this->moviesList, $newMovie);
            }
        }

        public function getGenre()
        {
            $object = json_decode(file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=" . KEY . "&language=es&page=1"), FALSE);
            //var_dump($object);
            foreach($object->results as $movie)
            {
                $newMovie = new Movie($movie->id, $movie->adult, $movie->title, $movie->overview, $movie->original_language, $movie->genre_ids);

                array_push($this->moviesList, $newMovie);
            }
        }

    }
?>