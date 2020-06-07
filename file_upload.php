<?php  
include("db_connection.php");
if(count($_FILES["image"]["tmp_name"]) > 0) {  
    $badUploads = 0;
    foreach($_FILES['image']['tmp_name'] as $val){
        file_put_contents("logs.txt", "");
        $filename = addslashes(file_get_contents($val));
        $query = "INSERT INTO images(address) VALUES ('$filename')";  
        $statement = $connect->prepare($query);
        $success = $statement->execute();
        if(!$success) {
            $badUploads = $badUploads + 1;
        }
    }
    if($badUploads = 0) {  
        echo '<script>alert("Image(s) uploaded successfully")</script>';  
    } else {
        echo '<script>alert("Image(s) failed to upload")</script>';    
    }
}
?> 