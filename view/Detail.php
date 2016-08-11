<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>簡易銀行系統</title>
</head>
<body>
    <table style="border-top:3px #FFD382 solid;border-bottom:3px #82FFFF solid;" cellpadding="10" border='0'>
        <tr>
            <th>出款</th>
            <th>入款</th>
            <th>時間</th>
            <th>餘額</th>
        </tr>
        <?php foreach($data as $key => $value) { ?>
            <tr>
                <td><?php echo $value['withdraw']; ?></td>
                <td><?php echo $value['deposit']; ?></td>
                <td><?php echo $value['datetime']; ?></td>
                <td><?php echo $value['balance']; ?></td>
            </tr>
         <?php } ?>
    </table>
</body>
</html>