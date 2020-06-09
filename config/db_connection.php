<?php  
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300);

$connect = new PDO('mysql:host=localhost;dbname=test', 'root', 'HireMePlease');
?>  