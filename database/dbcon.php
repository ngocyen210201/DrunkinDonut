<?php
$sname= "localhost:3360";
$uname= "root";
$password = "Ngocyen*2102";
$db_name = "drunkindonut";

$con = mysqli_connect($sname, $uname, $password, $db_name) or die ("cannot connect");
class db{
    private $servername = "localhost:3360";
    private $username = "root";
    private $password = "Ngocyen*2102";
    private $db = "drunkindonut";
    
                // PAGINATION
    public function connect(){
        $this->conn = null;
        try {
        $this->conn = new PDO("mysql:host=" .$this->servername.";dbname=".$this->db."", $this->username, $this->password);
        // set the PDO error mode to exception
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
        } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        }
        return $this->conn;
    }
}
?>