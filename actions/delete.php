<?php

include('../config/db_connection.php');

function deleteQuery($value_to_delete) {
    include('../config/db_connection.php');
    $query = "DELETE FROM images WHERE image_id = {$value_to_delete}";
    $statement = $connect->prepare($query);
    $statement->execute();

}

if(isset($_POST["image_id"]))
{
    deleteQuery($_POST["image_id"]);   
}

?>