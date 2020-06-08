<?php

include('db_connection.php');
file_put_contents("logs.txt", $_POST["img_id"]);
if(isset($_POST["img_id"]))
{
    $query = "
        UPDATE images 
        SET name = '".$_POST["name"]."', description = '".$_POST["description"]."' 
        WHERE image_id = '".$_POST["img_id"]."'
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
}

?>