<?php


namespace Models;


class User
{
    private $id;
    private $name;
    private $lastName;
    private $email;
    private $password;
    private $listMovie;
    private $listTicket;

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email=$email;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function setLastName($lastName){
        $this->lastName=$lastName;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getListMovie(){
        return $this->listMovie;
    }

    public function setListMovie($listMovie){
        $this->listMovie=$listMovie;
    }
    public function getListTicket(){
        return $this->listTicket;
    }

    public function setListTicket($listTicket){
        $this->listTicket=$listTicket;
    }
}