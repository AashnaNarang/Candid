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
                <button type="button" name="delete_all" id="delete_all" class="btn btn-danger">Delete All Selected</button>
                <br />  
                <br />
                <div class="table-responsive" id="image_table"></div> 
            </div>
    </body>
</html>

<div id="imageModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="POST" id="edit_image_form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Image Details</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Image Name</label>
                    <input type="text" name="name" id="name" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Image Description</label>
                    <input type="text" name="description" id="description" class="form-control" />
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="image_id" id="image_id" />
                <input type="submit" name="submit" class="btn btn-info" value="Save" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>

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

    function validate_image() {
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
            } else {
                return true;
            }
        } 
    }

    
    $('#upload').on('submit', function(event){
        event.preventDefault();
        var image_name = $('#image').val();
        if(validate_image()) {
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

    $(document).on('click', '.delete', function(){
        var image_id = $(this).attr("id");
        var image_name = $(this).data("image_name");
        console.log(image_id);
        if(confirm("Are you sure you want to remove this image?")) {
            $.ajax({
                url:"delete.php",
                method:"POST",
                data:{image_id:image_id, image_name:image_name},
                success:function(data) {
                    load_image_data();
                    alert("Image successfully removed");
                }
            });
        }
    }); 

    $(document).on('click', '.edit', function(){
        var image_id = $(this).attr("id");
        $.ajax({
            url:"edit.php",
            method:"POST",
            data:{image_id:image_id},
            dataType:"json",
            success:function(data)
            {
                $('#image_id').val(image_id);
                $('#image_name').val(data.image_name);
                $('#image_description').val(data.image_description);
                $('.modal-title').text("Update Information");
                $('#imageModal').modal('show');
            }
        });
    });

    $(document).on('click', '.save', function(){
        var image_id = $(this).attr("id");
        $.ajax({
            url:"edit.php",
            method:"POST",
            data:{image_id:image_id},
            dataType:"json",
            success:function(data)
            {
                $('#imageModal').modal('show');
                $('#image_id').val(image_id);
                $('#image_name').val(data.image_name);
                $('#image_description').val(data.image_description);
            }
        });
    }); 

    $('#edit_image_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:"update.php",
            method:"POST",
            data:$('#edit_image_form').serialize(),
            success:function(data)
            {
                $('#imageModal').modal('hide');
                load_image_data();
                alert('Image Details updated');
            }
        });
    }); 

});  
</script>