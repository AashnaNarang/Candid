<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../Candid/pages/login.php");
    exit;
}
?>
 <!DOCTYPE html> 

 <html>  
      <head>  
           <title>Candid.</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <div class="container"> 
                <?php include("basics.php");?>
                <br />  
                <br />  
                <div class="gallery" align="center">
                <?php 
                    include('../actions/create_gallery.php');
                    $error = 'Uh oh! Looks like your gallery is empty. Go to Image Management to add pictures.';
                    if (isset($_SESSION["username"])) {
                        create_gallery($_SESSION["username"], $error);
                    } else {
                        echo 'Looks like there is a problem with your account. Try logging out and logging in again.';
                    }
                    
                ?>
                </div>  
           </div>  
      </body>  
 </html>  
