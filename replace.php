<?php  
include("db_connection.php");
if(isset($_POST["image_id"])){
    if(count($_FILES["image"]["tmp_name"]) == 1) {  
        $file = addslashes(file_get_contents($_FILES['image']['tmp_name'][0]));
        $query = "UPDATE images SET address = '$file' WHERE image_id = '".$_POST["image_id"]."'";
        $statement = $connect->prepare($query);
        $success = $statement->execute();
        if($success) {  
            echo "Image replaced";  
        } else {
            echo "Failed to replace image";    
        }
    } else {
        echo "Please select one image";  
    }
}

?> 