<?php


namespace Models;


class Genres
{
    private $id;
    private $name;

    public function setName($name){
        $this->name=$name;
    }

    public function setId($id){
        $this->id=$id;
    }

    public function getName(){
        return $this->name;
    }

    public function getId(){
        return $this->id;
    }
    //probando

}