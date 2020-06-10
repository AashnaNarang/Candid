<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../pages/index.php");
    exit;
}
 
include('../config/db_connection.php');
require("helpers/validate.php");
 
$username = $password = "";
$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    checkEmptyAndTrim($_POST["username"], $username_err, "a username", $username);
    checkEmptyAndTrim($_POST["password"], $password_err, "a password", $password);
    
    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT user_id, username, password FROM users WHERE username = '{$username}'";
        $stmt = $connect->prepare($sql);
        if ($stmt->execute() && ($stmt->rowCount() == 1)) {
            if ($row = $stmt->fetch()){
                $id = $row["user_id"];
                $username = $row["username"];
                $hashed_password = $row["password"];
                if(password_verify($password, $hashed_password)) {
                    // Password is correct, so start a new session
                    session_start();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["username"] = $username;                            
                    header("location: ../pages/index.php");
                } else {
                    $password_err = "The password you entered was not valid.";
                }
            }
            unset($stmt);
        } else {
            $username_err = "No account found with that username.";
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
    unset($connect);
}
?>