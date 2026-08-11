<?php

$order = [
    'order_no' => 'A20260811001',
    'customer' => 'Amy',
    'subtotal' => '1500',
    'is_member' => true
];

function totalCash(array $order): array
{
    $orderNo = $order['order_no'];
    $customer = $order['customer'];
    $subtotal = (int) $order['subtotal'];
    $isMember = $order['is_member'];

    $total = $subtotal;

    if ($isMember === true && $subtotal >= 1000) {
        $total -= 100;

        return [
            'order_no' => $orderNo,
            'customer' => $customer,
            'subtotal' => $subtotal,
            'total' => $total,
            'discount' => 100
        ];
    }

    return [
        'order_no' => $orderNo,
        'customer' => $customer,
        'subtotal' => $subtotal,
        'total' => $total,
        'discount' => 0
    ];
}

$result = totalCash($order);

echo '訂單 ' . $result['order_no']
    . ' | ' . $result['customer']
    . ' | 原價 ' . $result['subtotal']
    . ' | 折扣 ' . $result['discount']
    . ' | 實付 ' . $result['total'];
