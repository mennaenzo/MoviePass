<?php


namespace Controllers;
use DAO\GenresDAO as GenresDAO;

use Models\Genres as Genres;

class GenreController
{
    private $genreDAO;
    public function __construct()
    {
        $this->genreDAO = new GenresDAO();
    }

    public function getGenresFromApi()
    {
        $arrayGenre = json_decode(file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=" . KEY . "&language=es&page=1"), true);

        foreach ($arrayGenre["genres"] as $genre) {
            $genres = new Genres();
            $genres->setName($genre["name"]);
            $genres->setId($genre["id"]);
            //array_push($this->genresList, $genres);
            $this->genreDAO->Add($genres);
        }
    }

}