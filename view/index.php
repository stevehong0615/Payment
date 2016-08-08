<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>簡易銀行系統</title>
</head>
<body>
    <form method="post" action="">
        <p>
            <input type="text" name="out" value="">
            <input type = "submit" name="btn1" value = "出款">
        </p>
        <p>
            <input type="text" name="in" value="">
            <input type = "submit" name="btn2" value = "存款">
        </p>
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