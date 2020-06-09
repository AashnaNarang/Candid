<?php  
include("db_connection.php");
include('start_session.php');

if(count($_FILES["image"]["tmp_name"]) > 0) {  
    $badUploads = 0;
    foreach($_FILES['image']['tmp_name'] as $val){
        $filename = addslashes(file_get_contents($val));
        if(isset($_SESSION["username"])) {
            $query = "INSERT INTO images(address, username) VALUES ('$filename', '".$_SESSION["username"]."')"; 
            file_put_contents("logs.txt", $query); 
            $statement = $connect->prepare($query);
            $success = $statement->execute();
            if(!$success) {
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