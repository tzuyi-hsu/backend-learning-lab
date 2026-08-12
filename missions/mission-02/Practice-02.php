<?php
    
    function total($order){
        $order_no = $order['order_no'];
        $customer = $order['customer'];
        $amount = $order['amount'];
        $is_member = $order['is_member'];

        if($amount >= 1000 || ($amount >= 500 && $is_member === true)){
            return [
                'order_no' => $order_no,
                'customer' => $customer ,
                'amount' => $amount ,
                'shipping' => 0,
                'total' => $amount
            ];
        }return   [
                'order_no' => $order_no ,
                'customer' => $customer ,
                'amount' => $amount ,
                'shipping' => 80,
                'total' => $amount + 80
            ];
    }


    $order = [
    'order_no' => 'A002',
    'customer' => 'Ben',
    'amount' => 850,
    'is_member' => true
    ];

    $result = total($order);
    echo $result['order_no']."|".$result['customer']."|".$result['amount']."|".$result['shipping']."|".$result['total'];
?>