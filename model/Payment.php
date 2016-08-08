<?php
class Payment extends Connect{
    // 抓取資料表全部資料
    function findAll()
    {
        $balance = $this->db->prepare("SELECT * FROM `count_action`");
        $balance->execute();
        $result = $balance->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    // 寫入出款金額與計算餘額
    function takeCount($num)
    {
        // 撈出目前餘額
        $balance = $this->db->prepare("SELECT `money` FROM `Balance`");
        $balance->execute();
        $result = $balance->fetchAll(PDO::FETCH_ASSOC);
        
        // 餘額扣除出款金額
        $balanceNum = $result[0]['money']-$num;
        
        // 將餘額存入資料表
        $inCountData = $this->db->prepare("INSERT INTO `count_action` (`out`, `balance_action`) VALUES (:out, :balance_action)");
        $inCountData->bindParam(':out', $num);
        $inCountData->bindParam(':balance_action', $balanceNum);
        $inCountData->execute();
        
        // 修改目前餘額
        $inBalanceData = $this->db->prepare("UPDATE `Balance` SET `money` = :money");
        $inBalanceData->bindParam(':money', $balanceNum);
        $inBalanceData->execute();
        return true;
    }
}