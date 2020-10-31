<?php
    namespace Models;

    class Cinema {
        private $id;
        private $name;
        private $address;
        //private $roomList;  hacer get and set

        /**
         * @return mixed
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * @param mixed $name
         */
        public function setName($name)
        {
            $this->name = $name;
        }

        /**
         * @return mixed
         */
        public function getAddress()
        {
            return $this->address;
        }

        /**
         * @param mixed $address
         */
        public function setAddress($address)
        {
            $this->address = $address;
        }

        public function setId($id)
        {
            $this->id = $id;
        }
        public function getId()
        {
            return $this->id;
        }

      /*   public function getTicketPrice()
        {
            return $this->ticketPrice;
        }
*/
    }
?>