<?php 
    include("../actions/load_images.php");
    function create_gallery($user, $error) { 
        $output = load_images_by_user($user);
        $result = $output['result'];
        $numRows = $output['numRows'];
                
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
        } else {
            echo $error;
        }
    } 

?> 