<?php

require_once('UserRegistration.php');
require_once('connexion.php');



$userRegistration = new UserRegistration($con);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    $errorMessage = $userRegistration->registerUser($firstname, $lastname, $phone, $email, $password, $confirmpassword);

    if (strpos($errorMessage, 'successfully') !== false) {
        header("Location: ../login.php");
    }
}

?>
