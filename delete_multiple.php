<?php

//delete.php

include('database_connection.php');

if(isset($_POST["checkbox_value"]))
{
    for($count = 0; $count < count($_POST["checkbox_value"]); $count++)
    {
        $query = "DELETE FROM images WHERE id = '".$_POST['checkbox_value'][$count]."'";
        $statement = $connect->prepare($query);
        $statement->execute();
    }
}
?>