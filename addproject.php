<?php
require_once('config/connexion.php');
require_once('class_landing_po.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$addProjects = new ProjectManagement($con);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $projectname = $_POST['projectname'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];
    $teamId = $_POST['teamId'];
    $validTeamId = $addProjects-> validateTeamId($teamId, $con);

    $addProjects -> ProjectAdded($teamId,$validTeamId);
    
}


?>
