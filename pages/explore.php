<?php
include('../config/start_session.php');
function load_users() {
    include("../config/db_connection.php");
    if (isset($_SESSION["username"])) {
        $query = "SELECT username FROM users WHERE username NOT IN ('".$_SESSION["username"]."') ORDER BY username ASC";
    } else {
        $query = "SELECT username FROM users ORDER BY username ASC";
    }    
    $statement = $connect->prepare($query);
    $statement->execute();
    $output['result'] = $statement->fetchAll();
    $output['numRows'] = $statement->rowCount();
    return $output;
}
?>
 <!DOCTYPE html> 

    <html>  
        <head>  
           <title>Candid.</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
        </head>  
        <body>  
           <div class="container">  
                <div class="page-header" align="right">
                    <h5>Hi, <b><?php if(isset($_SESSION["username"])) echo htmlspecialchars($_SESSION["username"]); ?></b></h5>
                    <a type="button" class="btn btn-danger btn-xs logout" href="logout.php">Log Out</a>
                </div>
                <h2 align="center"><b>Candid.</b></h2>  
                <br />
                <!-- TODO figure out how to reuse the code -->
                <div class="topnav" align="center">
                    <a href="index.php">Gallery</a>
                    <a class="active" href="image_manage.php">Image Management</a>
                    <a href="explore.php">Explore</a>
                </div> 
                <br/>  
                <br/>
                <div class="gallery" align="center">
                <?php  
                $output = load_users();
                $result = $output['result'];
                $numRows = $output['numRows'];
                if ($numRows > 0) {
                    foreach($result as $row) {
                        $url = "view_user.php?username=".$row["username"];
                        file_put_contents("logs.txt", $url);
                            echo '  
                                <tr>  
                                    <td>  
                                        <a href="'.$url.'"><img src="../images/blank_picture.png" height="350" width="350" /> </a>
                                    </td> 
                                </tr>  
                            ';  
                        }
                } else {
                    echo 'No other users :(';
                }
                ?>   
        </body>
    </html>