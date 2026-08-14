<?php

    // Method：POST
    // Content-Type：application/json

    // {
    // "order_no": "A010",
    // "amount": 1800,
    // "is_member": true 
    // }

    $method = $_SERVER['REQUEST_METHOD'];

    if($method !== 'POST'){
        http_response_code(405);
        $rsp = [
            'success' => false,
            'msg' => "Method Not Allowed"
        ];
        header('content-type: application/json');
        echo json_encode($rsp);
        return;
    }

    $rs = file_get_contents('php://input');
    $data = json_decode($rs,true);

    if($data === null){
        http_response_code(400);
        $rsp = [
            'success' => false,
            'msg' => "json 格式錯誤"
        ];
        header('content-type: application/json');
        echo json_encode($rsp);
        return;
    }
    
    $order_no = $data['order_no']?? null;

    if($order_no === null){
        http_response_code(400);
        $rsp = [
            'success' => false,
            'msg' => "order_no 為必填"
        ];
        header('content-type: application/json');
        echo json_encode($rsp);
        return;        
    }

    $amount = $data['amount']?? null;
    if($amount === null){
        http_response_code(400);
        $rsp = [
            'success' => false,
            'msg' => "amount 為必填"
        ];
        header('content-type: application/json');
        echo json_encode($rsp);
        return;        
    }
    http_response_code(201);
    $is_member = $data['is_member']??null;

    $rsp = [
        'success' => true,
        'data' =>[
            'order_no' => $order_no,
            'amount' => $amount,
            'is_member' => $is_member
        ]
    ];

    header('content-type: application/json');
    echo json_encode($rsp);
?>