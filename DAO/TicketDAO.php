<?php
    namespace DAO;
    
    use \Exception as Exception;
    use DAO\Connection as Connection;
    use Models\Tickets as Tickets;
    use DAO\CinemaDAO as CinemaDAO;
    use DAO\MovieDAO as MovieDAO;
    use DAO\RoomDAO as RoomDAO;
    

    class TicketDAO
    {
        private $ticketList;
        private $connection;
        private $tableName = "Tickets";
    

            public function __construct()
            {
                $this->showDAO=new ShowDAO();
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
            $ticketList = array();
                try{
                    $query = "SELECT id, price, idShow, idUser, quantity, total FROM " . $this->tableName . " where idUser = $idUser;";
                   
                    $this->connection = Connection::GetInstance();
                    $result = $this->connection->Execute($query);

                    if($result) {
                        foreach ($result as $value) {
                            $ticket = new Tickets();
                            $ticket->setId($value["id"]);
                            $ticket->setPrice($value["price"]);
                            $ticket->setShow($this->showDAO->GetShowById($value["idShow"]));
                            $ticket->setUser($value["idUser"]);
                            $ticket->setQuantity($value["quantity"]);
                            $ticket->setTotal($value["total"]);
                            array_push($ticketList, $ticket);
                        }
                    }
                    else{
                        $ticketList = null;
                    }
                }catch (Exception $ex){
                    throw $ex;
                }
                return $ticketList;
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