<?php
    
    function statusRisk(string $payment_status, int $amount, bool $is_member):string 
    {
        if ($payment_status !== "paid"){
            return "待確認";
        }if ($amount >= 3000 && $is_member === false ){
            return "高風險";
        }return "正常";
    }


    $order = [
        'order_no' => 'A005',
        'amount' => 2000,
        'is_member' => true,
        'payment_status' => '000'
    ];

    $status = statusRisk($order['payment_status'],$order['amount'],$order['is_member']);

    echo $order['order_no']."|".$order['amount']."|".$status;
?>