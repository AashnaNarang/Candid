<?php
function checkEmptyAndTrim($value, &$error_message, $value_name, &$trimmed) {
    $trimmed = trim($value);
    if(empty($trimmed)) {
        $error_message = "Please enter {$value_name}";
        return false;
    }
    return true;
}
?>