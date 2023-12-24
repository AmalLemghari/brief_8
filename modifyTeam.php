<?php
require_once('config/connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newteamId']) && isset($_POST['teamId'])) {
    $teamId = mysqli_real_escape_string($con, $_POST['teamId']);
    $newteamId = mysqli_real_escape_string($con, $_POST['newteamId']);

    // Check if the new teamId already exists
    $query = "SELECT * FROM equipe WHERE id = '$newteamId'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        // Handle the case where the new teamId already exists
        die("Error: The new team ID already exists.");
    } else {
        // Perform the modification query
        $update_query = "UPDATE equipe SET id = '$newteamId' WHERE id = '$teamId'";
        mysqli_query($con, $update_query);

        // Redirect back to the page after modification
        header('Location: landing_sm.php');
        exit();
    }
}
?>