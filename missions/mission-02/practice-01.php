<?php
    
    function produStatus($product){
        $name = $product['name'] ;
        $stock = $product['stock'];


        if( $stock === 0 ){
            return [
                'name' => $name,
                'stock' => $stock,
                'status' => "缺貨"
            ];
            } 
        
        if( $stock < 5){
                return [
                'name' => $name,
                'stock' => $stock,
                'status' => "低庫存"
            ];
            } 
                
                return [
                'name' => $name,
                'stock' => $stock,
                'status' => "有庫存" 
            ] ;
        
        
        }
    $product = [
    'name' => 'Mechanical Keyboard',
    'stock' => 0
    ];
    $result = produStatus($product);

    echo $result['name']." | ".$result['stock']." | ". $result['status'] ;


?>