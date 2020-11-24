<?php
    namespace DAO;

    use DAO\IShowDAO as IShowDAO;
    use DAO\CinemaDAO as CinemaDAO;
    use DAO\MovieDAO as MovieDAO;
    use Models\Cinema as Cinema;
    use Models\Room as Room;
    use Models\Show as Show;
    use \Exception as Exception;
    use DAO\Connection as Connection;

    class ShowDAO implements IShowDAO
    {
        ///private $roomList = array();
        private $connection;
        private $tableName = "Shows";
        private $roomDAO;
        private $movieDAO;

        public function __construct()
        {
            $this->roomDAO=new RoomDAO();
            $this->movieDAO=new MovieDAO();
        }

        public function Add(Show $show)
        {
            try {
                $query = "INSERT INTO " . $this->tableName . " (showTime, showDay, idMovie, idRoom) VALUES (:showTime, :showDay, :idMovie, :idRoom);";
                $parameters["showTime"] = $show->getTime();
                $parameters["showDay"] = $show->getDay();
                $parameters["idMovie"] = $show->getMovie()->getId();
                $parameters["idRoom"] = $show->getRoom()->getId();
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
                return 1;
            } catch (Exception $ex) {
                throw $ex;
                return 0;
            }
        }
        
        // Ver implementacion
        public function GetAll()
        {
            $showList = array();
            try {
                $query = "SELECT showTime, showDay, idMovie,  idRoom FROM " . $this->tableName . ";";
                $this->conecction->GetInstance();
                $result = $this->connection->Execute($query);
                if ($result) {
                    foreach ($result as $value) {
                        $newShow = new Show();
                        $newShow->setId($value["id"]);
                        $newShow->setId($value["showTime"]);
                        $newShow->setId($value["showDay"]);
                        $newShow->setId($value["idMovie"]);
                        $newShow->setId($value["idRoom"]);
                        array_push($showList, $newShow);
                    }
                }
            } catch (Exception $ex) {
                throw $ex;
                return 0;
            }

            return $showList;
        }

        //Retorna las funciones de una sala en especial
        public function GetShow($idRoom)
        {
            $showList = array();
            try {
                $query = "SELECT id, showTime, showDay, idMovie, idRoom FROM " . $this->tableName . " WHERE idRoom = $idRoom;";
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);
                if ($result) {
                    foreach ($result as $value) {
                        $newShow = new Show();
                        $newShow->setId($value["id"]);
                        $newShow->setTime(substr_replace($value["showTime"], "", -3));
                        $newShow->setDay($value["showDay"]);
                        $newShow->setMovie($this->movieDAO->GetMovie($value["idMovie"]));
                        $newShow->setRoom($this->roomDAO->GetRoom($idRoom));
                        array_push($showList, $newShow);
                    }
                }
            } catch (Exception $ex) {
                throw $ex;
                return 0;
            }

            return $showList;
        }

        public function ExistShowByDay($date, $idMovie, $idCinema)
        {
            try {
                $query = "SELECT * FROM shows s
                inner join rooms r on r.id = s.idRoom 
                inner join cinemas c on c.id = r.idCinema
                WHERE s.idMovie = '$idMovie' and s.showDay = '$date' and c.id <> '$idCinema';";
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);
                if ($result <> null) {
                    return $result[0]["id"];
                } else {
                    return 0;
                }
            } catch (Exception $ex) {
                throw $ex;
                return 0;
            }
        }
       
        public function GetShowsByDay($date)
        {
            try {
                $query = "select s.id 'idShow', s.showTime, s.idRoom, c.id 'idCinema', s.idMovie, m.runtime from " . $this->tableName . " s 
                inner join movies m on m.id = s.idMovie
                inner join rooms r on r.id = s.idRoom
                inner join cinemas c on c.id = r.idCinema
                where showDay = '$date'
                order by showTime;";
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);
                return $result;
            } catch (Exception $ex) {
                throw $ex;
                return 0;
            }
        }

        public function GetShowByMovie($idMovie){
            $showList = array();
           try{
               $query = "SELECT id, showTime, showDay, idRoom FROM " . $this->tableName . " WHERE idMovie = $idMovie;";
               $this->connection = Connection::GetInstance();
               $result = $this->connection->Execute($query);
               if($result){
                   foreach($result as $value){
                       $newShow = new Show();
                       $newShow->setId($value["id"]);
                       $newShow->setTime(substr_replace($value["showTime"], "", -3));
                       $newShow->setDay($value["showDay"]);
                       $newShow->setMovie($this->movieDAO->GetMovie($idMovie));
                       $newShow->setRoom($this->roomDAO->GetRoom($value["idRoom"]));
                       array_push($showList, $newShow);
                   }
               }
    
           }catch(Exception $ex){
               throw $ex;
               return 0;
           }
    
           return $showList;
       }

       public function GetShowById($idShow)
        {
            try {
                $query = "SELECT id, showTime, showDay, idMovie, idRoom FROM " . $this->tableName . " WHERE id= $idShow;";
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);
                if ($result) {
                    foreach ($result as $value) {
                        $newShow = new Show();
                        $newShow->setId($value["id"]);
                        $newShow->setTime(substr_replace($value["showTime"], "", -3));
                        $newShow->setDay($value["showDay"]);
                        $newShow->setMovie($this->movieDAO->GetMovie($value["idMovie"]));
                        $newShow->setRoom($this->roomDAO->GetRoom($value["idRoom"]));
                    }
                }
            } catch (Exception $ex) {
                throw $ex;
                return 0;
            }

            return $newShow;
        }

        public function GetTicketSales($idCine, $idMovie, $shift)
        {
            $ticketSales = array();
            $cantTickets = array();
            try{

                if(($idCine == 0) && ($idMovie == 0))
                {
                    $query = "select s.id 'idShow', s.showTime, s.showDay, s.idRoom, c.id 'idCinema', s.idMovie, sum(t.quantity)'sold', r.capacity - sum(t.quantity)'unsold' from shows s 
                    inner join movies m on m.id = s.idMovie
                    inner join rooms r on r.id = s.idRoom
                    inner join cinemas c on c.id = r.idCinema
                    inner join tickets t on t.idShow = s.id
                    where statusShow = 1
                    group by idMovie
                    order by showDay, showTime;";
                }
                elseif(($idCine <> 0) && ($idMovie == 0))
                {
                    $query = "select s.id 'idShow', s.showTime, s.showDay, s.idRoom, c.id 'idCinema', s.idMovie, sum(t.quantity)'sold', r.capacity - sum(t.quantity)'unsold' from shows s 
                    inner join movies m on m.id = s.idMovie
                    inner join rooms r on r.id = s.idRoom
                    inner join cinemas c on c.id = r.idCinema
                    inner join tickets t on t.idShow = s.id
                    where statusShow = 1 and c.id = $idCine
                    group by idMovie
                    order by showDay, showTime;";
                }
                elseif(($idCine == 0) && ($idMovie <> 0))
                {
                    $query = "select s.id 'idShow', s.showTime, s.showDay, s.idRoom, c.id 'idCinema', s.idMovie, sum(t.quantity)'sold', r.capacity - sum(t.quantity)'unsold' from shows s 
                    inner join movies m on m.id = s.idMovie
                    inner join rooms r on r.id = s.idRoom
                    inner join cinemas c on c.id = r.idCinema
                    inner join tickets t on t.idShow = s.id
                    where statusShow = 1 and m.id = $idMovie
                    group by idMovie
                    order by showDay, showTime;";
                }
                else
                {
                    $query = "select s.id 'idShow', s.showTime, s.showDay, s.idRoom, c.id 'idCinema', s.idMovie, sum(t.quantity)'sold', r.capacity - sum(t.quantity)'unsold' from shows s 
                    inner join movies m on m.id = s.idMovie
                    inner join rooms r on r.id = s.idRoom
                    inner join cinemas c on c.id = r.idCinema
                    inner join tickets t on t.idShow = s.id
                    where statusShow = 1 and m.id = $idMovie and c.id = $idCine
                    group by idMovie
                    order by showDay, showTime;";
                }

                //echo $query . "<br>" . $idCine . "<br>" . $idMovie . "<br>" . $shift;;
                
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);
                if($result){
                    foreach($result as $key => $value){
                        $newShow = new Show();
                        $newShow->setId($value["idShow"]);
                        $newShow->setTime(substr_replace($value["showTime"], "", -3));
                        $newShow->setMovie($this->movieDAO->GetMovie($value["idMovie"]));
                        $newShow->setDay($value["showDay"]);
                        $newShow->setRoom($this->roomDAO->GetRoom($value["idRoom"]));
                        $cantTickets["sold"] = $value["sold"];
                        $cantTickets["unsold"] = $value["unsold"];
                        $ticketSales[$key]["show"] = $newShow;
                        $ticketSales[$key]["cant"] = $cantTickets;
                    }
                }

            //var_dump($ticketSales);
     
            }catch(Exception $ex){
                throw $ex;
                return 0;
            }

            if($shift <> 0)
            {
                return $this->filterShift($ticketSales, $shift);
            }else{
                return $ticketSales;
            }
            
        }

        private function filterShift($ticketSales, $shift)
        {
            $limitShift = date("H:i", mktime(12));
            $newTicketSales = array();
            $i = 0;
            
            foreach($ticketSales as $ticket)
            {
                if($shift == 1)
                {
                    if(strtotime($ticket["show"]->getTime()) <= strtotime($limitShift))
                    {
                        array_push($newTicketSales, $ticketSales[$i]);
                    }
                }else{
                    if(strtotime($ticket["show"]->getTime()) > strtotime($limitShift))
                    {
                        array_push($newTicketSales, $ticketSales[$i]);
                    }
                }
                $i++;
            }
            //var_dump($newTicketSales);
            return $newTicketSales;
        }

        public function GetTotalSales($idCine, $idMovie, $date)
        {
            $ticketSales = array();
            $total = array();
            try{

                if(($idCine == 0) && ($idMovie == 0))
                {
                    $query = "select s.id 'idShow', s.showTime, s.showDay, s.idRoom, c.id 'idCinema', s.idMovie, sum(t.total)'total' from shows s 
                    inner join movies m on m.id = s.idMovie
                    inner join rooms r on r.id = s.idRoom
                    inner join cinemas c on c.id = r.idCinema
                    inner join tickets t on t.idShow = s.id
                    where statusShow = 1
                    group by idMovie
                    order by showDay, showTime;";
                }
                elseif(($idCine <> 0) && ($idMovie == 0))
                {
                    $query = "select s.id 'idShow', s.showTime, s.showDay, s.idRoom, c.id 'idCinema', s.idMovie, sum(t.total)'total' from shows s 
                    inner join movies m on m.id = s.idMovie
                    inner join rooms r on r.id = s.idRoom
                    inner join cinemas c on c.id = r.idCinema
                    inner join tickets t on t.idShow = s.id
                    where statusShow = 1 and c.id = $idCine
                    group by idMovie
                    order by showDay, showTime;";
                }
                elseif(($idCine == 0) && ($idMovie <> 0))
                {
                    $query = "select s.id 'idShow', s.showTime, s.showDay, s.idRoom, c.id 'idCinema', s.idMovie, sum(t.total)'total' from shows s 
                    inner join movies m on m.id = s.idMovie
                    inner join rooms r on r.id = s.idRoom
                    inner join cinemas c on c.id = r.idCinema
                    inner join tickets t on t.idShow = s.id
                    where statusShow = 1 and m.id = $idMovie
                    group by idMovie
                    order by showDay, showTime;";
                }
                else
                {
                    $query = "select s.id 'idShow', s.showTime, s.showDay, s.idRoom, c.id 'idCinema', s.idMovie, sum(t.total)'total' from shows s 
                    inner join movies m on m.id = s.idMovie
                    inner join rooms r on r.id = s.idRoom
                    inner join cinemas c on c.id = r.idCinema
                    inner join tickets t on t.idShow = s.id
                    where statusShow = 1 and m.id = $idMovie and c.id = $idCine
                    group by idMovie
                    order by showDay, showTime;";
                }
                
                $this->connection = Connection::GetInstance();
                $result = $this->connection->Execute($query);
                if($result){
                    foreach($result as $key => $value){
                        $newShow = new Show();
                        $newShow->setId($value["idShow"]);
                        $newShow->setTime(substr_replace($value["showTime"], "", -3));
                        $newShow->setMovie($this->movieDAO->GetMovie($value["idMovie"]));
                        $newShow->setDay($value["showDay"]);
                        $newShow->setRoom($this->roomDAO->GetRoom($value["idRoom"]));
                        $ticketSales[$key]["show"] = $newShow;
                        $ticketSales[$key]["cant"] = $value["total"];
                    }
                }

            return $ticketSales;

            }catch(Exception $ex){
                throw $ex;
                return 0;
            }
        }
    }
