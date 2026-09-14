<?php
// 使用者購買商品時，系統要扣庫存。
// 庫存不足時丟出 InsufficientStockException。
// 購買成功後發送通知。
// Controller 負責處理庫存不足時的對外訊息
// PurchaseService::purchase($quantity)
//         ↓
// 呼叫 InventoryManager 的 deduct($quantity)
//         ↓
// 如果沒有 Exception
//         ↓
// 呼叫 MessageSender 的 send("購買成功")
class InsufficientStockException extends Exception
{
}

interface InventoryManager
{
    public function deduct(int $quantity): void;
}

interface MessageSender
{
    public function send(string $message): void;
}

class PurchaseService
{
    public function  __construct(
        private InventoryManager $inventory ,
        private MessageSender $sender){}

    public function purchase(int $quantity): void
    {
        $this->inventory->deduct($quantity) ;
        $this->sender->send('購買成功');
    }
}

class PurchaseController
{
    public function __construct(
        private PurchaseService $purchaseService
    ) {
    }

    public function checkout(int $quantity): void
    {
        try {
            $this->purchaseService->purchase($quantity);
        }catch(InsufficientStockException $e){
            echo '庫存不足，請調整購買數量';
        }
    }
}

$inventory = new InventoryManager;
$sender = new MessageSender;

$purchaseService = new PurchaseService($inventory,$sender);


?>