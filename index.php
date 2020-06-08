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
           <br /><br />  
           <div class="container">  
                <h2 align="center">Candid.</h2>  
                <br />
                <!-- TODO figure out how to reuse the code -->
                <div class="topnav" align="center">
                    <a href="index.php">Gallery</a>
                    <a class="active" href="image_manage.php">Image Management</a>
                </div> 
                <br />  
                <br />  
                <div class="gallery" align="center">
                <?php  
                    include("load_images.php");
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
                }
                ?> 
                </div>  
           </div>  
      </body>  
 </html>  
