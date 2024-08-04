<?php

class BaseModel
{
    private $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    protected $con;

    public function openConnection()
    {
        try {
            $this->con = new PDO("mysql:host=localhost;dbname=".DB_NAME, DB_USER, DB_PASS, $this->options);
            return $this->con;
        } catch (PDOException $e) {
            echo "There is some problem on connection: " . $e->getMessage();
        }
    }

    public function closeConnection()
    {
        $this->con = null;
    }

    public function create(array $data)
    {
        $user_name = $data["user_name"];
        $password = $data["password"];
    }

    public function readByUserName(string $user_name) {
        $sql = "SELECT user_name, password, email FROM users WHERE user_name=:user_name";
        $query = $this->con->prepare($sql);
        $query->bindParam(':user_name', $user_name, PDO::PARAM_STR);
        
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}
