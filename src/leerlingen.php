<?php
require_once('src/db.php');

class leerlingen {
    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function getAllLeerlingen(){
        $query = "SELECT * FROM leerlingen";
        $result = $this->db->query($query);
        $leerlingen = array();
        while ($row = $result->fetch_assoc()) {
            $leerlingen[] = $row;
        }
        return $leerlingen;
    }

     public function getLeerlingById($id) {
        $query = "SELECT * FROM `leerlingen` WHERE `id`='$id'";
        $result = $this->db->query($query);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    public function createLeerling($firstName, $lastName, $email, $password, $class) {
        $query = "INSERT INTO `leerlingen` (`firstName`, `lastName`, `email`, `password`, `class`) VALUES ('$firstName', '$lastName', '$email', '$password', '$class')";
        $this->db->query($query);
    }

    // public function updateLeerling($id, $firstName, $lastName, $email, $password, $class){
    //     $query = "UPDATE `leerlingen` SET `firstName`='$firstName',`lastName`='$lastName',`email`='$email',`password`='$password', `class`='$class' WHERE `id` = $id";
    //     $this->db->query($query);
    // }
    public function deleteLeerling($id) {
        $query = "DELETE FROM `leerlingen` WHERE `id`=$id;";
        $this->db->query($query);
    }

    public function getScore($id){
        $query = "SELECT * FROM `score` WHERE `leerling_id`='$id'";
        $result = $this->db->query($query);
        $scores = array();
        while ($row = $result->fetch_assoc()) {
            $scores[] = $row;
        }
        return $scores;
    }
    // public function

    public function saveScore($score, $firstName, $lastName){
        $query = "SELECT `id` FROM `leerlingen` WHERE `firstName` = '$firstName' AND `lastName` = '$lastName'";
        $result = $this->db->query($query);
        if ($result && $row = $result->fetch_assoc()) {
            $id = $row['id'];
            $query = "INSERT INTO `score`(`leerling_id`, `score`) VALUES ($id, $score)";
            $this->db->query($query);
        } else {
            echo("Leerling niet gevonden");
        }
    }
}
