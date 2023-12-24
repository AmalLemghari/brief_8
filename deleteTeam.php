<?php
require_once('config/connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['teamId'])) {
    // Fetch the email from the form
    $teamId = $_POST['teamId'];

    // Perform the deletion query
    $delete_query = "DELETE FROM equipe WHERE id = '$teamId'";
    mysqli_query($con, $delete_query);

    // Redirect back to the page after deletion
    header('Location: landing_sm.php');
    exit();
}
?>
