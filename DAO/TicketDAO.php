<?php
    namespace DAO;
    
    use \Exception as Exception;
    use DAO\Connection as Connection;
    use Models\Tickets as Tickets;
    

    class TicketDAO
    {
        private $ticketList;
        private $connection;
        private $tableName = "Tickets";
        private $roomDAO;

            public function __construct()
            {
                $this->roomDAO=new RoomDAO();
            }


        public function Add(Tickets $ticket){
            try {
                $query = "insert into " . $this->tableName . " (id, price, idShow, idUser, quantity, total) values (;";
                $parameters["showTime"] = $show->getTime();
                $parameters["showDay"] = $show->getDay();
                $parameters["idMovie"] = $show->getMovie()->getId();
                $parameters["idRoom"] = $show->getRoom()->getId();
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                return 1;


            }catch (Exception $ex){
                throw $ex;
            }





        }

        public function GetAll(){}

        public function GetReservedAmount($idShow){
            $quantity = 0;
            try{
                $query = "select sum(quantity) as total from " . $this->tableName . " where $idShow = 1;";

                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);

                if($result){
                    foreach($result as $value){
                        $quantity = $value["total"];
                    }
                }
            }catch (Exception $ex){
                throw $ex;
            }
            return $quantity;

        }

        public function GetTotalCapacity($idShow){
            $capacity = 0;
            try{
                $query = "SELECT distinct r.capacity FROM " . $this->tableName . " t
                            right join shows s on s.id = t.idShow
                            inner join rooms r on r.id = s.idRoom
                            where s.id = $idShow and r.statusRoom = 1;";

                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);

                if($result){
                    foreach($result as $value){
                        $quantity = $value["capacity"];
                    }
                }
            }catch (Exception $ex){
                throw $ex;
            }
            return $quantity;

        }
    }