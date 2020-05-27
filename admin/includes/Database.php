<?php 

class Database {

    public $connection;

 
    public function __construct(){
        $this->open_db_connection();
    }

    // method to open database connection
    public function open_db_connection () {

        // $this->connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        if(!$this->connection) {
            die ("connected failed");
        }
    }

    // query method 

    public function query($sql) {

        $result = $this->connection->query($sql);
        $this->confirm_query($result);
        return $result;
    }

    // method to confirm the query 

    private function confirm_query($result) {
        if(!$result) {

            die('there is no result set ' . $this->connection->error);
        }
    }

    // method to escape string 

    public function escape_string($string) {
         $escaped_string = mysqli_real_escape_string($this->connection,$string);
         return $escaped_string;
    }

    // public function insert id 

    public function the_insert_id() {
        return mysqli_insert_id($this->connection);
    }

}

$database = new Database();


?>



