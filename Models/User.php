<?php


namespace Models;


class User
{
    private $id;
    private $userName;
    private $lastName;
    private $email;
    private $userPassword;
    private $esAdmin;
    private $listMovie;
    private $listTicket;

    public function getEmail(){
        return $this->email;
    }

    public function getEsAdmin()
    {
        return $this->esAdmin;
    }

    public function setEsAdmin($esAdmin)
    {
        $this->esAdmin = $esAdmin;
    }

    public function setEmail($email){
        $this->email=$email;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;
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
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;
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