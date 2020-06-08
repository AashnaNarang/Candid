<?php
include('db_connection.php');

$query = "
SELECT * FROM images 
WHERE image_id = '".$_POST["image_id"]."'
";

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

foreach($result as $row)
{
 $output['image_name'] = $row["name"];
 $output['image_description'] = $row["description"];
}

echo json_encode($output);

?>