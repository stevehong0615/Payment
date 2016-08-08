<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>簡易銀行系統</title>
</head>
<body>
    <form method="post" action="/Payment/Home/outMoney">
        輸入姓名：
        <input type="text" name="outName" value="">
        輸入金額：
        <input type="text" name="outNumber" value="">
        <input type = "submit" name="btn" value = "出款">
    </form>
    </br>
    <form method="post" action="/Payment/Home/inMoney">
        輸入姓名：
        <input type="text" name="inName" value="">
        輸入金額：
        <input type="text" name="inNumber" value="">
        <input type = "submit" name="btn" value = "存款">
    </form>
    <br/>
    <form method="post" action="/Payment/Home/allList">
        輸入姓名：
        <input type="text" name="detailName" value="">
        <input type = "submit" name="btn" value = "明細查詢">
    </form>
</body>
</html>