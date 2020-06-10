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
            } else {
                alert("Select atleast one record to delete");
            }
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