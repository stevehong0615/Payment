<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>簡易銀行系統</title>
</head>
<body>
    <form method="post" action="/Payment/Home/outMoney">
        <input type="text" name="outNumber" value="">
        <input type = "submit" name="btn" value = "出款">
    </form>
    </br>
    <form method="post" action="/Payment/Home/inMoney">
        <input type="text" name="inNumber" value="">
        <input type = "submit" name="btn" value = "存款">
    </form>
----------------------------------------------    
    <table>
        <tr>
            <th>出款</th>
            <th>入款</th>
            <th>餘額</th>
        </tr>
        <?php foreach($data as $key => $value) { ?>
            <tr>
                <td><?php echo $value['out']; ?></td>
                <td><?php echo $value['in']; ?></td>
                <td><?php echo $value['balance_action']; ?></td>
            </tr>
         <?php } ?>
    </table>
</body>
</html>