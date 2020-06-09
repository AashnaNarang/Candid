<?php
include('start_session.php');
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
                <div class="page-header" align="right">
                    <h5>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h5>
                    <a type="button" class="btn btn-danger btn-xs logout" href="logout.php">Log Out</a>
                </div>
                <h2 align="center"><b>Candid.</b></h2>  
                <br />
                <!-- TODO figure out how to reuse the code -->
                <div class="topnav" align="center">
                    <a href="index.php">Gallery</a>
                    <a class="active" href="image_manage.php">Image Management</a>
                    <a href="explore.php">Explore</a>
                </div> 
                <br />  
                <br />  
                <div class="gallery" align="center">
                <?php  
                include("load_images.php");
                if(isset($_SESSION["username"])) {
                    $output = load_images_by_user($_SESSION["username"]);
                    $result = $output['result'];
                    $numRows = $output['numRows'];
                
                    if ($numRows > 0) {
                        foreach($result as $row) {
                                echo '  
                                    <tr>  
                                        <td>  
                                            <img src="data:image/jpeg;base64,'.base64_encode($row['address'] ).'" height="350" width="350" />  
                                        </td>  
                                    </tr>  
                                ';  
                            }
                    } else {
                        echo 'Uh oh! Looks like your gallery is empty. Go to Image Management to add pictures.';
                    }
                } else {
                    echo 'Looks like there is a problem with your account. Try logging out and logging in again.';
                }
                ?> 
                </div>  
           </div>  
      </body>  
 </html>  
