# Mission 03｜HTTP Request / Response 與 PHP API 基礎

## Mission 目標

理解 HTTP Request / Response 的基本資料流，並使用 PHP 實作簡單的 JSON API。

本 Mission 重點不是框架，而是理解 Client 傳送 Request 後，資料如何進入 PHP、經過驗證與處理，再組成 Response 回傳。

---

## 學習內容

### 1. HTTP Request / Response

Request 基本結構：

- Method
- URL
- Header
- Body

Response 基本結構：

- Status Code
- Header
- Body

基本資料流：

```text
Client
↓
HTTP Request
↓
PHP Backend
↓
Validation / Processing
↓
HTTP Response
↓
Client
```

---

### 2. GET 與 Query String

Query String 通常用於查詢條件，例如：

```text
GET /products?category=keyboard&page=2
```

PHP 可透過：

```php
$_GET['category'];
$_GET['page'];
```

取得資料。

---

### 3. POST 與 JSON Request Body

讀取 Request Body：

```php
$rawBody = file_get_contents('php://input');
```

將 JSON 轉成 PHP associative array：

```php
$data = json_decode($rawBody, true);
```

安全取得欄位：

```php
$name = $data['name'] ?? null;
```

---

### 4. Request Method

使用：

```php
$_SERVER['REQUEST_METHOD'];
```

取得目前 Request Method。

例如限制 API 只能使用 POST：

```php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
}
```

---

### 5. Validation

處理 Request 時依序確認：

```text
Method 是否正確
↓
JSON 是否能正常解析
↓
必要欄位是否存在
↓
進行實際處理
```

錯誤發生後回傳 Response，並使用 `return` 結束目前流程，避免繼續執行後續邏輯。

---

### 6. JSON Response

設定 Response Content-Type：

```php
header('Content-Type: application/json');
```

將 PHP array 轉成 JSON：

```php
echo json_encode($response);
```

---

## HTTP Status Code

本 Mission 使用：

| Status Code | 意義 | 使用情境 |
|---|---|---|
| 200 | OK | 一般請求成功 |
| 201 | Created | 成功建立新資源 |
| 400 | Bad Request | Request 格式或輸入資料有問題 |
| 404 | Not Found | 找不到指定資源 |
| 405 | Method Not Allowed | API 不接受目前的 HTTP Method |
| 500 | Internal Server Error | Server 內部錯誤 |

---

## Independent Build

完成一支建立訂單的 JSON API。

Request：

```json
{
  "order_no": "A010",
  "amount": 1800,
  "is_member": true
}
```

API 會依序處理：

```text
Request Method
↓
Request Body
↓
JSON Decode
↓
JSON Validation
↓
Required Field Validation
↓
201 Created
↓
JSON Response
```

處理的錯誤情境包含：

- 非 POST Request → 405
- JSON 格式錯誤 → 400
- 缺少 `order_no` → 400
- 缺少 `amount` → 400
- Request 正常 → 201

主要 Evidence：

```text
independent-build.php
```

---

## Reflection

### 我學會了什麼？

這個 Mission 讓我理解 HTTP Request 進入 PHP 後的完整資料流。

現在會先判斷 HTTP Method 是否符合 API 規格，再讀取 JSON Request Body 並轉成 PHP array，確認 JSON 格式沒有問題後，再進行必要欄位的 Validation，最後組成 HTTP Response 回傳。

### 目前容易忘記的地方

HTTP Status Code 的使用情境仍然比較容易混淆，需要透過後續實作持續熟悉。

目前需要優先記住：

```text
200 → 一般成功
201 → 成功建立資源
400 → Request 資料有問題
404 → 找不到資源
405 → Method 不允許
500 → Server 內部錯誤
```