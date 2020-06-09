<?php
include('../config/start_session.php');
?>
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
                <div class="page-header" align="right">
                    <h5>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h5>
                    <a type="button" class="btn btn-danger btn-xs logout" href="logout.php">Log Out</a>
                </div>
                <h2 align="center"><b>Candid.</b></h2>  
                <br />  
                <div class="topnav" align="center">
                    <a href="index.php">Gallery</a>
                    <a class="active" href="image_manage.php">Image Management</a>
                    <a href="explore.php">Explore</a>
                </div>
                <button type="button" name="add" id="add" class="btn btn-success">Add</button>
                <button type="button" name="delete_all" id="delete_all" class="btn btn-danger">Delete All Selected</button>
                <br />  
                <br />
                <div class="table-responsive" id="image_table"></div> 
            </div>
    </body>
</html>

<!-- TODO: Re-use modal code -->
<div id="infoModal" class="modal fade" role="dialog">
    <div class="modal-dialog" id="modal_dialog">
        <div class="modal-content">
        <form method="post" id="edit_image_form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Image Info</h4>
            </div>
            <div class="modal-body" id="edit_info">
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
                <input type="hidden" name="img_id" id="img_id" />
                <input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div id="imageModal" class="modal fade" role="dialog">
    <div class="modal-dialog>
        <div class="modal-content">
        <form method="POST" id="image_form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Image</h4>
            </div>
            <div class="modal-body" id="edit_image">
                <form id="image_form" method="post" enctype="multipart/form-data">
                    <p><label>Select Image</label>
                        <input type="file" name="image[]" id="image" multiple accept=".jpg, .jpeg, .png, .gif" />
                    </p>
                    <br />
                    <input type="hidden" name="image_id" id="image_id" />
                    <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" />
                    <input type="hidden" name="action" id="action" value="insert" />
                </form>
            </div>
            <div class="modal-footer">
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
            url:"../actions/load_images_table.php",
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

    $('#add').click(function(){
        $('#imageModal').modal('show');
        $('#image_form')[0].reset();
        $('.modal-title').text("Add Image");
        $('#image_id').val('');
        $('#action').val("insert");
    });

    $('#image_form').submit(function(event){
        event.preventDefault();
        var action = document.getElementById('action').getAttribute('value');
        if(action == "insert") {
            url = "../actions/file_upload.php";
        } else if(action == "replace") {
            url = "../actions/replace.php";
        }
        if(validate_image()) {
            $.ajax({
                url: url,
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                success:function(data)
                {
                    $('#image_form')[0].reset();
                    $('#imageModal').modal('hide');
                    load_image_data();
                    alert(data);
                }
            });
        }
    });

    $(document).on('click', '.delete', function(){
        var image_id = $(this).attr("id");
        var image_name = $(this).data("image_name");
        if(confirm("Are you sure you want to remove this image?")) {
            $.ajax({
                url:"../actions/delete.php",
                method:"POST",
                data:{image_id:image_id, image_name:image_name},
                success:function(data) {
                    load_image_data();
                    alert("Image successfully removed");
                }
            });
        }
    }); 

    $('#delete_all').click(function(){
        var checkbox = $('.delete_checkbox:checked');

        if(confirm("Are you sure you want to remove selected image(s)?")) {
            if(checkbox.length > 0) {
                var checkbox_value = [];
                $(checkbox).each(function(){
                    checkbox_value.push($(this).val());
                });
                $.ajax({
                    url:"../actions/delete_multiple.php",
                    method:"POST",
                    data:{checkbox_value:checkbox_value},
                    success:function()
                    {
                        load_image_data();
                    }   
                });
            }
        } else {
            alert("Select atleast one record to delete");
        }
    });


    $(document).on('click', '.edit', function(){
        var image_id = $(this).attr("id");
        $.ajax({
            url:"../actions/edit.php",
            method:"POST",
            data:{image_id:image_id},
            dataType:"json",
            success:function(data)
            {
                $('#infoModal').modal('show');
                $('#img_id').val(image_id);
                $('#name').val(data.image_name);
                $('#description').val(data.image_description);
                $('.modal-title').text("Update Information");
                
            }
        });
    }); 

    $('#edit_image_form').submit(function(event){
        event.preventDefault();
        $.ajax({
            url:"../actions/update_info.php",
            method:"POST",
            data:$('#edit_image_form').serialize(),
            success:function(data)
            {
                $('#infoModal').modal('hide');
                load_image_data();
                alert('Image Info updated');
            }
        });
    });

    $(document).on('click', '.replace', function() {
        $('#image_form')[0].reset();
        $('#image_id').val($(this).attr("id"));
        $('.modal-title').text("Replace Image");
        $('#action').val("replace");
        $('#imageModal').modal('show');
    }); 

});  
</script>
