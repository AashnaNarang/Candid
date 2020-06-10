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
                <div class="page-header" align="right">
                    <h5>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h5>
                    <a type="button" class="btn btn-danger btn-xs logout" href="logout.php">Log Out</a>
                    <h2 align="center"><b>Candid.</b></h2> 
                </div>
                <?php
                    if(isset($_GET["username"])) {
                        $viewing = $_GET["username"];
                        echo "<h3 align='center'>{$viewing}'s Gallery.</h3>";
                    } else {
                        echo "Uh oh. Looks like there is an issue with this user";
                    }
                ?>
                <br />
                <div class="topnav" align="center">
                    <a href="index.php">Gallery</a>
                    <a class="active" href="image_manage.php">Image Management</a>
                    <a href="explore.php">Explore</a>
                </div> 
                <br />  
                <br />  
                
                <div class="gallery" align="center">
                <?php  
                    include('../actions/create_gallery.php');
                    $error = "Uh oh! Looks like {$viewing}'s gallery is empty. Try again later.";
                    create_gallery($viewing, $error);
                ?> 
            </div>  
        </div>  
      </body>  
 </html>  