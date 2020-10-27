<?php
    namespace DAO;

    use \Exception as Exception;
    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;
    use DAO\Connection as Connection;

    class UserDAO implements IUserDAO
    {
        ///private $userList = array();
        private $connection;
        private $tableName = "Users";

        public function  Add(User $user){
            try{
                $query = "INSERT INTO ".$this->tableName." (name, lastName, email, password) VALUES (:name, :lastName, :email, :password);";

                $parameters["name"] = $user->getName();
                $parameters["lastName"] = $user->getLastName();
                $parameters["email"] = $user->getEmail();
                $parameters["password"] = $user->getPassword();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch (Exception $ex)
            {
                throw $ex;
            }
        }

        public function SearchUser($email, $password){
            try{
                $query = "SELECT * FROM " . $this->tableName . " WHERE email = '".$email."';";

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                if($resultSet){
                    foreach ($resultSet as $row){
                        $user = new User();
                        $user->setId($row["id"]);
                        $user->setName($row["name"]);
                        $user->setLastName("lastName");
                        $user->setEmail($row["email"]);
                        $user->setPassword($row["password"]);
                    }
                    if($user->getPassword() != $password){
                        $user = null;
                    }
                }
            }
            catch (Exception $ex){
                throw $ex;
            }
            return $user;
        }


        /* Funciones para trabajar con JSON
        public function Add(User $user)
        {
            $this->RetrieveData();
            
            array_push($this->userList, $user);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->userList;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->userList as $user)
            {
                $valuesArray["name"] = $user->getName();
                $valuesArray["lastName"] = $user->getLastName();
                $valuesArray["email"] = $user->getEmail();
                $valuesArray["password"] = $user->getPassword();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('Data/users.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->userList = array();

            if(file_exists('Data/users.json'))
            {
                $jsonContent = file_get_contents('Data/users.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $user = new User();
                    $user->setName($valuesArray["name"]);
                    $user->setLastName($valuesArray["lastName"]);
                    $user->setEmail($valuesArray["email"]);
                    $user->setPassword($valuesArray["password"]);

                    array_push($this->userList, $user);
                }
            }
        }
        */
    }
?>