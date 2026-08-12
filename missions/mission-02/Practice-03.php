<?php
    

    function totalPrice($price , $is_member){
        if ($is_member === true){
            $price = $price*0.9 ;
            return $price;
        }return $price;
    }

    function stockStatus($stock){
        if ($stock === 0){
            return "缺貨";
        }
        if ($stock < 5){
            return "低庫存";
        }return  "正常";
    }

    $product = [
    'name' => 'Wireless Mouse',
    'price' => 1200,
    'stock' => 4,
    'is_member' => false
    ];


    $priceRs = totalPrice($product['price'],$product['is_member']);
    $stockRs = stockStatus($product['stock']);

    echo $product['name']."|".$priceRs."|".$stockRs;
?>