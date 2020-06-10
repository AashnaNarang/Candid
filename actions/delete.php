<?php

include('../config/db_connection.php');
require('../actions/helpers/execute_query.php');

function delete_query($value_to_delete) {
    $query = "DELETE FROM images WHERE image_id = {$value_to_delete}";
    execute_query($query);
}

if(isset($_POST["image_id"]))
{
    delete_query($_POST["image_id"]);   
}

?>