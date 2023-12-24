<?php
require_once('connexion.php');

class AuthenticationHandler {
    private $con;
    private $errorMessage;

    public function __construct($dbConnection) {
        $this->con = $dbConnection;
        $this->errorMessage = '';
    }

    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $loginEmail = $_POST['loginEmail'];
            $loginPassword = $_POST['loginPassword'];
            $hashedPassword = base64_encode($loginPassword);

            $query = "SELECT * FROM users WHERE email = '$loginEmail' AND password = '$hashedPassword'";
            $result = mysqli_query($this->con, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $userData = mysqli_fetch_assoc($result);
                $this->redirectBasedOnRole($userData['role']);
            } else {
                $this->handleInvalidLogin($loginEmail);
            }
        }
    }

    private function redirectBasedOnRole($role) {
        switch ($role) {
            case 'product owner':
                $this->redirectTo('../landing_po.php');
                break;
            case 'scrum master':
                $this->redirectTo('../landing_sm.php');
                break;
            case 'member':
                $this->redirectTo('../landing_mem.php');
                break;
            default:
                $this->errorMessage = "Invalid role for user.";
        }
    }

    private function handleInvalidLogin($loginEmail) {
        $query = "SELECT * FROM users WHERE email = '$loginEmail'";
        $result = mysqli_query($this->con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $this->errorMessage = "Wrong password";
        } else {
            $this->errorMessage = "Wrong email";
        }
    }

    private function redirectTo($location) {
        header("Location: $location");
        exit();
    }

    public function getErrorMessage() {
        return $this->errorMessage;
    }
}