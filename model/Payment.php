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
        $balance = $this->db->prepare("SELECT `money` FROM `Balance`");
        $balance->execute();
        $result = $balance->fetchAll(PDO::FETCH_ASSOC);
        echo $result[0]['money'];
    }
}