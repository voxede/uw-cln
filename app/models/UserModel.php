<?php

class UserModel extends BaseModel
{
    protected $con = null;

    public function __construct()
    {
        $this->con = $this->openConnection();
    }

    public function create(array $data)
    {
        $user_name = $data['user_name'];
        $email = $data['email'];
        $password = $data['password'];

        $sql = "INSERT INTO users (user_name, email, password) VALUES (:user_name, :email, :password)";

        $query = $this->con->prepare($sql);

        // Bind parameters
        $query->bindParam(':user_name', $user_name, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);

        // Query execution
        $query->execute();

        $lastInsertId = $this->con->lastInsertId();
        if($lastInsertId)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function readFromUserName($user_name)
    {
        return $this->readByUserName($user_name);
    }
}
