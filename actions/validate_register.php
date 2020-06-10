<?php
include('../config/db_connection.php');
require("helpers/validate.php");

$user = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
 
    if(checkEmptyAndTrim($_POST["username"], $username_err, "a username", $user)) {
        $query = "SELECT user_id FROM users WHERE username = '{$user}'";
        $statement = $connect->prepare($query);
        if ($statement->execute()) {
            $rows = $statement->rowCount(); 
            if ($rows == 1) {
                $username_err = "This username is already taken.";
            } else if($rows != 0) {
                echo "Oops! Something went wrong. Please try again later.";
            }
            unset($statement);
        }
    }
    
    if(checkEmptyAndTrim($_POST["password"], $password_err, "a password", $password)) {    
        if(strlen($password) < 6) {
            $password_err = "Password must have atleast 6 characters.";
        }
    }

    if(checkEmptyAndTrim($_POST["confirm_password"], $confirm_password_err, "password to confirm", $confirm_password)) {
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }


    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password) VALUES ('{$user}', '{$param_password}')";
        if($stmt = $connect->prepare($sql)){
            if($stmt->execute()){
                header("location: login.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }

            unset($stmt);
        }
    }

unset($connect);
}
?>