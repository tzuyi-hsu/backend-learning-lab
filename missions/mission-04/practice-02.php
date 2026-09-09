<!-- 題目：查詢單一會員
資料表：
members
----------------
id      PK
name
email
API：
GET /member.php?id=3
需求：
1. 只接受 GET，其他 Method → 405
2. 從 $_GET 取得 id
3. 沒有 id → 400
4. 使用 Prepared Statement：SELECT * FROM members WHERE id = :id
5. SQL 執行後，只取得 一筆會員資料
6. 查不到會員 → 404
7. 查到 → 200
成功 Response：
{
    "success": true,
    "data": {
        "id": 3,
        "name": "Kevin",
        "email": "kevin@example.com"
    }
} -->
<?php

$res = file_get_contents('PHP://input');
$Method = $_SERVER['REQUEST_METHOD'];

if($Method !== 'GET'){
    http_response_code(405);
    $respons = [
        'success' => false,
        'message' => "Method Not Allowed"
    ];
    header('ConTent-Type: application/json');
    echo json_encode($respons);
    return ;
}

$data = json_decode($res , true);
$id = $_GET['id'] ?? null;

if($id == null){
    http_response_code(400);
    $respons = [
        'success' => false,
        'message' => "請輸入ID"
    ];
    header('ConTent-Type: application/json');
    echo json_encode($respons);
    return ;
}

$stmt = $pdo->prepare(
    "SELECT * FROM members WHERE id = :id"
);
$stmt->execute([
    'id' => $id
]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if($data === false){
    http_response_code(404);
    $respons = [
        'success' => false,
        'message' => "查無此ID"
    ];
    header('ConTent-Type: application/json');
    echo json_encode($respons);
    return ;
}

$name = $data['name'];
$email = $data['email'];
    http_response_code(200);
    $respons = [
        'success' => true,
        'data' => $data
    ];
    header('ConTent-Type: application/json');
    echo json_encode($respons);
    return ;
?>
