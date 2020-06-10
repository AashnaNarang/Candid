<?php
include('../config/db_connection.php');
require("helpers/execute_query.php");

$query = "
SELECT * FROM images 
WHERE image_id = '".$_POST["image_id"]."'
";
$result = execute_query_result($query);
foreach($result as $row) {
    $output['image_name'] = $row["name"];
    $output['image_description'] = $row["description"];
}

echo json_encode($output);

?>