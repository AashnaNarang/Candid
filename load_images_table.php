<?php  
    include("load_images.php");
    include('start_session.php');

    if(isset($_SESSION["username"])) {
        $output = load_images_by_user($_SESSION["username"]);
        $result = $output['result'];
        $numRows = $output['numRows'];
    }
    
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
                            <button type="button" class="btn btn-warning btn-xs edit" id="'.$row["image_id"].'">Edit Info</button>
                            <button type="button" class="btn btn-info btn-xs replace" id="'.$row["image_id"].'">Replace Image</button>    
                            <button type="button" class="btn btn-danger btn-xs delete" id="'.$row["image_id"].'">Delete</button>
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