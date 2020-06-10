<?php
    require("../actions/helpers/execute_query.php");
    function load_users() {
        if (isset($_SESSION["username"])) {
            $query = "SELECT username FROM users WHERE username NOT IN ('".$_SESSION["username"]."') ORDER BY username ASC";
        } else {
            $query = "SELECT username FROM users ORDER BY username ASC";
        }    
        return execute_query_array($query);
    }
    $output = load_users();
    $result = $output['result'];
    $numRows = $output['numRows'];
    if ($numRows > 0) {
        foreach($result as $row) {
            $url = "view_user.php?username=".$row["username"];
                echo '  
                    <tr>  
                        <td>  
                            <a href="'.$url.'"><img src="../images/blank_picture.png" height="350" width="350" /> </a>
                        </td> 
                    </tr>  
                ';  
            }
    } else {
        echo 'No other users :(';
    }
?> 