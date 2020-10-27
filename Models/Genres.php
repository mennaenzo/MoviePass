<?php


namespace Models;


class Genres
{
    private $id_api;
    private $name;

    public function setName($name){
        $this->name=$name;
    }

    public function setId_api($id){
        $this->id_api=$id;
    }


    public function getName(){
        return $this->name;
    }

    public function getId_api(){
        return $this->id_api;
    }
    //probando

}