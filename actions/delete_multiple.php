<?php

require('delete.php');

if(isset($_POST["checkbox_value"]))
{
    foreach($_POST["checkbox_value"] as $val)
    {
        delete_query($val);
    }
}
?>