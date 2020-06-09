<?php

include('../config/db_connection.php');
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