<?php  
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300);
$connect = mysqli_connect("localhost", "root", "HireMePlease", "test");  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Candid.</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br /><br />  
           <div class="container">  
                <h3 align="center">Candid.</h3>  
                <br />  
                <br />  
                <table class="table table-bordered">  
                     <tr>  
                          <th>Images</th>  
                     </tr>  
                <?php  
                $query = "SELECT * FROM images ORDER BY image_id DESC";  
				$result = mysqli_query($connect, $query); 
				if (!$result) {
					printf("Error: %s\n", mysqli_error($connect));
					exit();
				} 
                while($row = mysqli_fetch_array($result))  
                {  
                     echo '  
                          <tr>  
                               <td>  
                                    <img src="data:image/jpeg;base64,'.base64_encode($row['address'] ).'" height="400" width="400" />  
                               </td>  
                          </tr>  
                     ';  
                }  
                ?>  
                </table>  
           </div>  
      </body>  
 </html>  
