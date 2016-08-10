<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>簡易銀行系統</title>
</head>
<body>
    <form method="post" action="/Payment/Home/dispensing">
        輸入姓名：
        <input type="text" name="dispensingId" value="">
        輸入金額：
        <input type="text" name="dispensingNumber" value="">
        <input type = "submit" name="btn" value = "出款">
    </form>
    </br>
    <form method="post" action="/Payment/Home/deposit">
        輸入姓名：
        <input type="text" name="depositId" value="">
        輸入金額：
        <input type="text" name="depositNumber" value="">
        <input type = "submit" name="btn" value = "存款">
    </form>
    <br/>
    <form method="post" action="/Payment/Home/allList">
        輸入姓名：
        <input type="text" name="detailId" value="">
        <input type = "submit" name="btn" value = "明細查詢">
    </form>
</body>
</html>