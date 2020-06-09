<?php  
    function load_images() {
        $query = "SELECT * FROM images ORDER BY image_id DESC";
        return execute_query($query);
    }

    function load_images_by_user($user) {
        $query = "SELECT * FROM images WHERE username = '{$user}' ORDER BY image_id DESC";
        return execute_query($query);
    }

    function execute_query($query){
        include("../config/db_connection.php");
        $statement = $connect->prepare($query);
        $statement->execute();
        $output['result'] = $statement->fetchAll();
        $output['numRows'] = $statement->rowCount();
        return $output;
    }
?>