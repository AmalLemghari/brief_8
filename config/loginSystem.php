<?php
require_once('connexion.php');
require_once('user.php');

$authenticationHandler = new AuthenticationHandler($con);
$authenticationHandler->handleLogin();
$errorMessage = $authenticationHandler->getErrorMessage();
?>