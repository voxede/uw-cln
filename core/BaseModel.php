<?php

require_once 'Database.php';

class BaseModel
{
    protected $db = null;

    public function connect()
    {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=".DB_NAME, DB_USER, DB_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch(PDOException $e) {
            exit("Error: " . $e->getMessage());
        }
    }

    public function disconnect()
    {
        $this->db = null;
    }
}
