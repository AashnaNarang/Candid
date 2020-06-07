<!DOCTYPE html>  
 <html>  
        <head>  
           <title>Candid.</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        </head>  
      <body>  
           <br /><br />  
           <div class="container">  
                <h2 align="center">Candid.</h3>  
                <br />  
                <div class="topnav" align="center">
                    <a href="index.php">Gallery</a>
                    <a class="active" href="image_manage.php">Image Management</a>
                </div>
                <form id="upload" method="post" enctype="multipart/form-data">  
                     <input type="file" name="image[]" id="image" multiple accept=".jpg, .jpeg, .png, .gif"/>  
                     <br />  
                     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" />  
                </form>
                <br />  
                <br />
                <div class="table-responsive" id="image_table">
                
                </div> 
            </div>
    </body>
</html>

<script>  
$(document).ready(function(){

    load_image_data();

    function load_image_data() {
        $.ajax({
            url:"load_images_table.php",
            method:"POST",
            success:function(data) {
                $('#image_table').html(data);
            }
        });
    } 
    
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
                    load_image_data();
                }
            });
        }
    });
 
});  
</script>