<?php
session_start();
//import users class
require_once('src/leerlingen.php');
$leerling = new leerlingen();

// initialize variables of all the user data for later use
$firstName = "";
$lastName = "";
$email = ""; 
$password = "";
$class = "";
$id = 0;
$update = false;

if (isset($_POST['save'])) {
    //saves the values of the form
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $class = $_POST['class'];

    //creates a user
    $leerling->createLeerling($firstName, $lastName, $email, $password, $class);

    //shows feedback of the action
    // $_SESSION['message'] = "leerling saved";

    //sends the user to index.php
    header('location: register.php');
}
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    
    //deletes user using the id of the user
    $leerling->deleteLeerling($id);
    
    //shows feedback of the action
    // $_SESSION['message'] = "User deleted!";
    header('location: register.php');
}