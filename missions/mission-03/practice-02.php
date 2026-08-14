<?php
    $rawBody =  file_get_contents('php://input');
    $data= json_decode($rawBody,true);

    $name = $data['name'] ?? null;
    $stock = $data['stock'] ?? null;

    if ($name === null){
        http_response_code(400);
        $response = [
            "success" => false ,
            "message" => "name為必填"
        ];
    }else{
        http_response_code(200);
        $response = [
            'success' => true ,
            'name' => $name,
            'stock' => $stock  
    ];
    }


  
    header('content-type: application/json');
    echo  json_encode($response);
    
    
   
?>