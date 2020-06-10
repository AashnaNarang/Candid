<?php  
    require("helpers/execute_query.php");
    function load_images() {
        $query = "SELECT * FROM images ORDER BY image_id DESC";
        return execute_query_array($query);
    }

    function load_images_by_user($user) {
        $query = "SELECT * FROM images WHERE username = '{$user}' ORDER BY image_id DESC";
        return execute_query_array($query);
    }
?>