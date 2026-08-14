<?php
    
    $res = file_get_contents('php://input');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method !== 'POST'){
        http_response_code(405);
        $response = [
            'success' => false,
            'msg' => "Method Not Allowed"
        ];
        header('content-type: application/json');
        echo json_encode($response);
        return;
        }

    $data = json_decode($res,true);   
    if( $data === null){
        http_response_code(400);
        $response = [
            'success' => false,
            'msg' => "JSON 格式錯誤"
        ];
        header('content-type: application/json');
        echo json_encode($response);
        return;
    } 


    $name = $data['name']?? null;
    $stock = $data['stock']?? null;
    if ($name === null){
        http_response_code(400);
        $response = [
            'success' => false,
            'msg' => "name 為必填"
        ];
        header('content-type: application/json');
        echo json_encode($response);
        return;
        
    }
    
        http_response_code(201);
        $response = [
            'success' => true,
            'data' => [
                'name' => $name,
                'stock' => $stock,
                'msg' => "商品建立成功"
            ]
        ];
    
    header('content-type: application/json');
    echo json_encode($response);
?>