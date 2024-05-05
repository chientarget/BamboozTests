<?php

include_once __DIR__ . '/../../connect/Database.php';


class Employee
{
    public $id;
    public $position;
    public $username;
    public $password;
    public $birthDate;
    public $email;
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    // Getter và setter cho $position
    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    // Getter và setter cho $username
    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    // Getter và setter cho $password
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    // Getter và setter cho $birthDate
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    // Getter và setter cho $email
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function checkLogin() {
        $sql = "SELECT * FROM Employee WHERE username = ? AND password = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$this->username, $this->password]);
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }
}

?>