<?php 
header("Access-Control-Allow-Origin: http://localhost");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
include 'includes/RequestDB.php';
$DB = new RequestDB('localhost', 'root','','tck');

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if($DB->Connection()!= false){
        $DB->SetQuery('SELECT * from regions');
        $rows= $DB->Request();
        http_response_code(200);
        echo json_encode($rows);
        exit();
    }
    
}
if($_SERVER["REQUEST_METHOD"]=="GET"){
    echo "get request";
    
}




?>