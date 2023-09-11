<?php
$json_data = file_get_contents("php://input");

if($json_data){
    echo "1";
}else{
    echo "0";
}
?>