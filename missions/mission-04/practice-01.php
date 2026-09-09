\<!-- 題目：新增會員
API 規格：
Method：POST
Content-Type：application/json
Request Body：
{
&#x20;   "name": "Kevin",
&#x20;   "email": "kevin\@example.com"
}
資料表：
members

id          PK、自動編號
name
email
需求：
\- 讀取 JSON Request Body 並轉成 PHP array。
\- name、email 都是必填；任一沒傳 → 400，回 success = false、message = 欄位為必填。
\- 驗證通過後，用 PDO Prepared Statement 新增到 members。
\- 取得資料庫自動產生的新 id。
\- 新增成功 → 201，回傳 success = true，以及 id、name、email。
\- Response 為 JSON。
假設 $pdo 已經連線完成，不用寫 DB Connection。 -->
<?php
   $res = file\_get\_contents('php\://input');
   $method =  $\_SERVER['REQUEST\_METHOD'];
   if  ($method != 'POST'){
       http\_response\_code(405);
       $respone = [
           'success' => false,
           'message' => "Method Not Allowed"
       ];
       header('Content-type: Application/json');
       echo json\_encode($respone);
       return;
   }
   $data = json\_decode($res,true);
   $name = $data['name']?? null;
   $email = $data['email']?? null;
   if($name == null || $email == null){
       http\_response\_code(400);
       $respone = [
           'success' => false,
           'message' => "name以及email為必填"
       ];
       header('Content-type: Application/json');
       echo json\_encode($respone);
       return;
   }

    $stmt =  $pdo->prepare(
     "INSERT INTO members (name , email)
     VALUES(:name , :email)"
     );

    $stmt->execute([
    'name' => $name,
    'email' => $email
    ]);


    $id = $pdo->lastInsertId();

        $response = [
    'success' => true,
    'data' => [
        'id' => $id,
        'name' => $name,
        'email' => $email
    ]
    ];
    http_response_code(201);
    header('Content-Type: application/json');
    echo json_encode($response);
?>
