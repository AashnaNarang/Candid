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
                <h2 align="center">Candid.</h3>  
                <br />  
                <form id="upload" method="post" enctype="multipart/form-data">  
                     <input type="file" name="image[]" id="image" multiple accept=".jpg, .jpeg, .png, .gif"/>  
                     <br />  
                     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" />  
                </form>  
                <br />  
                <br />  
                <div class="gallery" align="center">
                <?php  
                ini_set('mysql.connect_timeout', 300);
                ini_set('default_socket_timeout', 300);
                            
                $connect = mysqli_connect("localhost", "root", "HireMePlease", "test"); 
                $query = "SELECT * FROM images ORDER BY image_id DESC";
                $result = mysqli_query($connect, $query);
                if (!$result) {
		            printf("Error: %s\n", mysqli_error($connect));
		            exit();
	            } 
                while($row = mysqli_fetch_array($result)) {  
                    echo '  
                        <tr>  
                            <td>  
                                <img src="data:image/jpeg;base64,'.base64_encode($row['address'] ).'" height="350" width="350" />  
                            </td>  
                        </tr>  
                        ';  
                } 
                ?> 
                </div>  
           </div>  
      </body>  
 </html>  
<script>  
$(document).ready(function(){

    $('#upload').on('submit', function(event){
        event.preventDefault();
        var image_name = $('#image').val();
        if(image_name == '') {
            alert("Please select an image");
            return false;
        }
        else {
            var extension = $('#image').val().split('.').pop().toLowerCase();  
            if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1) {  
                alert('Invalid Image File');  
                $('#image').val('');  
                return false;  
            }  
            $.ajax({
                url:"file_upload.php",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                success:function(data)
                {
                    $('#image').val('');
                    alert("Image(s) successfully added");
                    location.reload();
                }
            });
        }
    });
 
});  
</script>
 