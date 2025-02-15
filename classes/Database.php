<?php
    namespace Maincast\App\Classes;

    class Database
    {
        private static $instance;
        private $mysqli;

        public function __construct()
        {
            $this->mysqli= new \mysqli('mysql', 'default', 'secret', 'default');

            if ($this->mysqli->connect_error)
            {
                die("Connection failed: " . $this->mysqli->connect_error);
            }
        }

        public static function getInstance()
        {
            if (self:: $instance === null ){
                self:: $instance = new self();
            }
            return self:: $instance;
        }

        public function getConnection()
        {
            return $this->mysqli;
        }


    }

?>