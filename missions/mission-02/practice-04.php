<?php

    function memberPoint(bool $is_member, int $amount): int{
        
        if ($is_member === true){
            return floor($amount / 100) ;
        } return 0 ;
    }

    

    $order = [
    'order_no' => 'A004',
    'amount' => 1680,
    'is_member' => true
    ];

    $points = memberPoint($order['is_member'],$order['amount']);
    
    echo $order['order_no']."|".$order['amount']."|".$points ;
?>