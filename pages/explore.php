<?php
include('../config/start_session.php');
?>
 <!DOCTYPE html> 
    <html>  
        <head>  
           <title>Candid.</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
        </head>  
        <body>  
           <div class="container">  
                <?php include("basics.php");?> 
                <br/>  
                <br/>
                <div class="gallery" align="center">
                <?php  require("../actions/load_users.php");?>   
        </body>
    </html>