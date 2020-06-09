<?php  
    function load_images() {
        include("db_connection.php");
        $query = "SELECT * FROM images ORDER BY image_id DESC";
        $statement = $connect->prepare($query);
        $statement->execute();
        $output['result'] = $statement->fetchAll();
        $output['numRows'] = $statement->rowCount();
        return $output;
    }

    function load_images_by_user($user) {
        include("db_connection.php");
        $query = "SELECT * FROM images WHERE username = '{$user}' ORDER BY image_id DESC";
        $statement = $connect->prepare($query);
        $statement->execute();
        $output['result'] = $statement->fetchAll();
        $output['numRows'] = $statement->rowCount();
        return $output;
    }
?>