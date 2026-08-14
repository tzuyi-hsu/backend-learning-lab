<?php
    

    $raw = file_get_contents('php://intput') ;

    $data = json_decode($raw , true);

    $order_no = $data['order_no']?? null;
    $amount = $data['amount']?? null;

    if ($amount === null){
        http_response_code(400) ;
        $response = [
            'success' => false , 
            'message' =>"amount為必填",
        ];
    }else{
        http_response_code(200);
        $response = [
            'success' => true,
            'order_no' => $order_no,
            'amount' => $amount
        ];
    }

    header('content-Type , application/json');
    echo json_encode($response);
?>