<?php

require_once('config/connexion.php');

if (isset($_POST['user_role'])) {
    $user_role = $_POST['user_role'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($user_role === 'member') {
            $user_id = $_POST['user_id'];
            $update_query = "UPDATE users SET role =  'scrum master' WHERE id = $user_id";

            if (mysqli_query($con, $update_query)) {
                header('Location: landing_po.php');
                exit();
            } else {
                echo "Error updating role: " . mysqli_error($con);
            }
        } elseif ($user_role == 'scrum master') {
            $userid = $_POST['user_idMem'];
            $update_query = "UPDATE users SET role =  'member' WHERE id = $userid";

            if (mysqli_query($con, $update_query)) {
                header('Location: landing_po.php');
                exit();
            } else {
                echo "Error updating role: " . mysqli_error($con);
            }
        }
    }
} else {
    echo "Error: 'user_role' not found in POST data.";
}

// Close the database connection
mysqli_close($con);
?>