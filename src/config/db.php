<?php
    class db{
        //Properties
        // private $dbhoat = 'localhost';
        // private $dbuser = 'root';
        // private $dbpass = '123456';
        // private $dbname = 'productservice';

        //connect
        public function connect(){
            $dbhost = 'productapiservice.000webhostapp.com/localhost';
            $dbuser = 'id5591861_productadmin';
            $dbpass = '123456789';
            $dbname = 'id5591861_product';
            // $mysql_connect_str = "$mysql:host=$this->dbhost;dbname=$this->dbname";
            $dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
            $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbConnection->exec('SET NAMES utf8');
            return $dbConnection;

        }
    }
    function test() {
        $dbhost = 'productapiservice.000webhostapp.com/localhost';
        $dbuser = 'id5591861_productadmin';
        $dbpass = '123456789';
        $dbname = 'id5591861_product';
        try {
            
        // $dbpass = '';
                $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
            
                // set the PDO error mode to exception
            
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                echo "Connected successfully"; 
            
                }
            
            catch(PDOException $e)
            
                {
            
                echo "Connection failed: " . $e->getMessage();
            
                }
            
            
    }
    // test();
    // echo '1234';

?>