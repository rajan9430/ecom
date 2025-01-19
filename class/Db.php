<?php // Start PHP tag

class Db // Define Db class
{

    private $host = 'localhost'; // Define database host
    private $username = 'root'; // Define database username
    private $password = ''; // Define database password
    private $database = 'myweb_ecom'; // Define database name
    protected $db; // Define protected property db for database connection

    public function __construct() // Constructor method
    {
        try { 
            $dsn = "mysql:host={$this->host}; dbname={$this->database};"; 
            $option = array(PDO::ATTR_PERSISTENT); 

            $this->db = new PDO($dsn, $this->username, $this->password, $option); 
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        } catch (PDOException $e) { 
            echo "Connection Error: " . $e->getMessage(); 
            exit; 
        }
    }
}
