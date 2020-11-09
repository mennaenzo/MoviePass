<?php


namespace Controllers;
use DAO\GenresDAO as GenresDAO;

use DAO\MovieDAO as MovieDAO;
use Models\Genres as Genres;

class GenresController
{
    private $genreDAO;
    private $movieDAO;
    public function __construct()
    {
        $this->genreDAO = new GenresDAO();
        $this->movieDAO = new MovieDAO();
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

            $this->ShowListView();
        }
    }

    public function ShowListView()
    {
        $movieList = $this->movieDAO->GetAll();
        require_once(VIEWS_PATH . "user-menu.php");
    }

}