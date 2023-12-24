<?php

class UserRegistration {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function registerUser($firstname, $lastname, $phone, $email, $password, $confirmpassword) {
        if ($password !== $confirmpassword) {
            return "Passwords do not match.";
        }

        $hashedPassword = base64_encode($password);

        $query = "INSERT INTO users (firstname, Lastname, phone, email ,password , role) VALUES ('$firstname', '$lastname', '$phone', '$email', '$hashedPassword' , 'member')";
        
        if (mysqli_query($this->con, $query)) {
            return "User registered successfully!";
        } else {
            return "Error: " . $query . "<br>" . mysqli_error($this->con);
        }
    }
}

?>
