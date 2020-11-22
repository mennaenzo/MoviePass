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
                $query = "insert into " . $this->tableName . " ( price, idShow, idUser, quantity, total) values (:price, :idShow, :idUser, :quantity, :total);";

                $parameters["price"] = $ticket->getPrice();
                $parameters["idShow"] =$ticket->getShow();
                $parameters["idUser"] = $ticket->getUser();
                $parameters["quantity"] = $ticket->getQuantity();
                $parameters["total"] = $ticket->getTotal();
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                return 1;

            }catch (Exception $ex){
                throw $ex;
                return 0;
            }
        }

        public function GetAllFromUser($idUser){
                try{
                    $query = "SELECT * FROM tickets where id = $idUser;";
                    $this->connection = Connection::GetInstance();
                    $result = $this->connection->Execute($query);

                    if($result) {
                        foreach ($result as $value) {
                            $ticket = new Tickets();
                            $ticket->setId($value["id"]);
                            $ticket->setPrice($value["price"]);
                            $ticket->setIdShow($value["idShow"]);
                            $ticket->setUser($value["idUser"]);
                            $ticket->setQuantity($value["quantity"]);
                            $ticket->setTotal($value["total"]);
                            array_push($this->ticketList, $ticket);
                        }
                    }
                    else{
                        $this->ticketList = null;
                    }
                }catch (Exception $ex){
                    throw $ex;
                }
                return $this->ticketList;
        }













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