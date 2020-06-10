<?php
function execute_query_array($query){
    $statement = execute_query_statement($query);
    $output['statement'] = $statement;
    $output['result'] = $statement->fetchAll();
    $output['numRows'] = $statement->rowCount();
    return $output;
}

function execute_query_result($query){
    $statement = execute_query_statement($query);
    return $statement->fetchAll();
}

function execute_query($query){
    include("../config/db_connection.php");
    $statement = $connect->prepare($query);
    return $statement->execute();  
}

function execute_query_statement($query){
    include("../config/db_connection.php");
    $statement = $connect->prepare($query);
    $statement->execute();
    return $statement;
}

?>