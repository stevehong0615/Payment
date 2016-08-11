<!DOCTYPE html>
<html>
<head>
<meta charset = "UTF-8">
<title>簡易銀行系統</title>
</head>
<body>
    <form method = "post" action = "/Payment/Home/accountAction">
        輸入使用者編號：
        <input type = "text" name = "userId" value = "" pattern = "[0-9]{1,15}">
        輸入金額：
        <input type = "text" name = "money" value = "" pattern = "[0-9]{1,15}">
        <input type = "submit" name = "btnWithDrawal" value = "出款">
        <input type = "submit" name = "btnDeposit" value = "存款">
    </form>
    <br/>
    <form method = "post" action = "/Payment/Home/detail">
        輸入使用者編號：
        <input type = "text" name = "userId" value = "" pattern = "[0-9]{1,15}">
        <input type = "submit" name = "btn" value = "明細查詢">
    </form>
    <form method = "post" action = "/Payment/Home/balance">
        輸入使用者編號：
        <input type = "text" name = "userId" value = "" pattern = "[0-9]{1,15}">
        <input type = "submit" name = "btn" value = "查詢餘額">
    </form>
</body>
</html>