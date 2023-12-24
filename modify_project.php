<?php
require_once('config/connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newProjectName'])) {
    $projectName = $_POST['projectName'];
    $newProjectName = mysqli_real_escape_string($con, $_POST['newProjectName']);
    $newDescription = mysqli_real_escape_string($con, $_POST['newDescription']);
    $newDeadline = mysqli_real_escape_string($con, $_POST['newDeadline']);
    $newTeamId = mysqli_real_escape_string($con, $_POST['newTeamId']);

    $update_query = "UPDATE projects SET project_name = '$newProjectName', description = '$newDescription', deadline = '$newDeadline', teamId = '$newTeamId' WHERE project_name = '$projectName'";
    
    if (mysqli_query($con, $update_query)) {
        // Update successful, redirect to landing page with a success message
        header('Location: landing_po.php?success=1');
        exit();
    } else {
        // Update failed, redirect to landing page with an error message
        header('Location: landing_po.php?error=1');
        exit();
    }
}
?>
