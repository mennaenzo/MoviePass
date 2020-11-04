<?php
    namespace DAO;

    use Models\User as User;

    interface IUserDAO
    {
        public function Add(User $user);
        ///function GetAll();
    }
?>