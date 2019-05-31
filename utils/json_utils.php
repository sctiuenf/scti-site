<?php 

function json_return($success, $message="", $e=null, $data_array = array()){
    
    //if it is a custom error, code = -2, else get the error code
    if($e)
        $error_code = count(get_object_vars($e)) > 0 ? $e->errorInfo[1]:-2;
    else
        $error_code = -1;//no error
    echo json_encode(array(
        'success' => $success,
        'message' => $message,
        'error_code' => $error_code,
        'data_array' => $data_array
    ));
    die;
}
?>