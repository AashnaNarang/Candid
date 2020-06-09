<?php

include('db_connection.php');
require("validate.php");

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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $user; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>