# Mission 01｜PHP 資料流基礎

## Goal
完成一條從輸入資料到輸出的純 PHP 小型資料流程。

## Scenario
收到一筆訂單資料後，判斷是否符合會員滿額折扣，計算實付金額，最後輸出訂單摘要。

## Input
一個 `$order` 關聯陣列：

- `order_no`
- `customer`
- `subtotal`
- `is_member`

## Rules
1. `subtotal` 原始型別是字串，計算前轉成整數。
2. 會員且 `subtotal >= 1000` 時折扣 100 元。
3. 其他情況折扣 0 元。
4. 實付金額 = 原價 - 折扣。

## Data Flow
`$order` → 傳入 `totalCash()` → 取出資料 → 轉換 `subtotal` 型別 → 判斷折扣 → 計算實付 → 回傳 associative array → `$result` 接住回傳值 → `echo` 輸出摘要。

## Expected Output
```text
訂單 A20260811001 | Amy | 原價 1500 | 折扣 100 | 實付 1400
```

## Test Cases
### Case 1
- subtotal: 1500
- is_member: true
- discount: 100
- total: 1400

### Case 2
- subtotal: 800
- is_member: true
- discount: 0
- total: 800

### Case 3
- subtotal: 1200
- is_member: false
- discount: 0
- total: 1200

## Reflection
這次 Final Build 重新串起了 function 的完整資料流：資料從參數傳入，函式內取出關聯陣列資料並做型別轉換與條件判斷，再用 `return` 把結果交回呼叫端。當需要一次回傳多筆相關資料時，可以包成 associative array；呼叫端要用變數接住 return 的結果，再從回傳陣列取值輸出。
