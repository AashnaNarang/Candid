<?php  
include("../config/db_connection.php");
include('../config/start_session.php');
require("helpers/execute_query.php");

if(count($_FILES["image"]["tmp_name"]) > 0) {  
    $badUploads = 0;
    foreach($_FILES['image']['tmp_name'] as $val){
        $filename = addslashes(file_get_contents($val));
        if(isset($_SESSION["username"])) {
            $query = "INSERT INTO images(address, username) VALUES ('$filename', '".$_SESSION["username"]."')";  
            if(!execute_query($query)) {
                $badUploads = $badUploads + 1;
            }
        } else {
            echo "Please sign in";
        } 
    }
    if($badUploads == 0) {  
        echo "Image(s) uploaded successfully";  
    } else {
        echo "Image(s) failed to upload";    
    }
}
?> 