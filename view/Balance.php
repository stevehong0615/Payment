<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>簡易銀行系統</title>
</head>
<body>
    <table style="border-top:3px #FFD382 solid;border-bottom:3px #82FFFF solid;" cellpadding="10" border='0'>
        <tr>
            <th>使用者編號</th>
            <th>目前餘額</th>
        </tr>
        <?php foreach($data as $key => $value) { ?>
            <tr>
                <td><?php echo $value['user_id']; ?></td>
                <td><?php echo $value['money']; ?></td>
            </tr>
         <?php } ?>
    </table>
</body>
</html>