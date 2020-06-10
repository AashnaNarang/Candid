<?php  
include("../config/db_connection.php");
include("helpers/execute_query.php");
if (isset($_POST["image_id"])) {
    if(count($_FILES["image"]["tmp_name"]) == 1) {  
        $file = addslashes(file_get_contents($_FILES['image']['tmp_name'][0]));
        $query = "UPDATE images SET address = '$file' WHERE image_id = '".$_POST["image_id"]."'";
        if (execute_query($query)) {  
            echo "Image replaced";  
        } else {
            echo "Failed to replace image";    
        }
    } else {
        echo "Please select one image";  
    }
}

?> 