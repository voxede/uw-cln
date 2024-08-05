<?php

class UserModel extends BaseModel
{
    public function create($user_name, $email, $password)
    {
        $this->connect();
        $sql  = "INSERT INTO users(user_name, email, password) VALUES(;user_name, :email, :password)";
        
        $query = $this->db->prepare($sql);

        $query->bindParam(':user_name', $user_name, PDO::PARAM_STR);

    }

    public function readByUserName($user_name)
    {
        $this->connect();

        $sql = "SELECT * FROM users WHERE user_name=:user_name";
        
        $query = $this->db->prepare($sql);
        $query->bindParam(':user_name', $user_name, PDO::PARAM_STR);
        $query->execute();
        
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        $this->disconnect();

        return $result;
    }
}
