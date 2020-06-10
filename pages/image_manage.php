<?php
include('../config/start_session.php');
?>
<!DOCTYPE html>  
    <html>  
        <head>  
           <title>Candid.</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        </head>  
        <body>  
            <div class="container"> 
                <?php include("basics.php");?> 
                <br /><br /> 
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

<script src="image_manage.js"></script>
