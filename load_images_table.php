<?php  
    include("load_images.php");
    
    $output = '';
    $output .= '
        <table class="table table-bordered table-striped">
            <tr>
                <th>  </th>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Options</th>
            </tr>
    ';
    
    if ($numRows > 0) {
        foreach($result as $row) {
            $output .= '
                <tr>
                    <td>
                        <input type="checkbox" class="delete_checkbox" value="'.$row["image_id"].'" />
                    </td>
                    <td><img src="data:image/jpeg;base64,'.base64_encode($row['address'] ).'" height="100" width="100" /></td>
                    <td>'.$row["name"].'</td>
                    <td>'.$row["description"].'</td>
                    <td>
                        <button type="button" class="btn btn-warning btn-xs edit" id="'.$row["image_id"].'">Edit</button>    
                        <button type="button" class="btn btn-danger btn-xs delete" id="'.$row["image_id"].'" data-image_name="'.$row["name"].'">Delete</button>
                    </td>
                </tr>
            ';
        }
    } else {
        $output .= '
            <tr>
                <td colspan="5" align="center">No Data Found</td>
            </tr>
        ';
    }

    $output .= '</table>';

    echo $output;
  
?> 