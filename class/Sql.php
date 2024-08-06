<?php
class Sql extends PDO
{
    private $conn;

    public function __construct(){
        $this->conn = new PDO("mysql:host=localhost;dbname=adminwork", "root", "");
    }

    private function setParam($statement, $key, $value){
        $statement->bindParam($key, $value);
    }
    
    private function setParams($statement, $parameters = array()){
        foreach ($parameters as $key => $value) {
            $statement->bindParam($key, $value);
            $this->setParam($statement, $key, $value);
        }

    }

    
    
    public function newQuery($rawQuery, $params = array()){
        $stmt = $this->conn->prepare($rawQuery);

        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt;
    }


    public function select($rawQuery, $params = array()){
        $stmt = $this->newQuery($rawQuery, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        

    }
}
?>