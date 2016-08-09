<?php

class Payment extends Connect
{
    // 抓取資料表全部資料
    function findAll($detailName)
    {
        $balance = $this->db->prepare("SELECT * FROM `count_action` WHERE `user_name` = :user_name");
        $balance->bindParam(':user_name', $detailName);
        $balance->execute();
        $result = $balance->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // 寫入出款金額與計算餘額
    function outCount($name, $num)
    {
        try {
            $this->db->beginTransaction();

            $balance = $this->db->prepare("SELECT `money` FROM `Balance` WHERE `user_name` = :user_name FOR UPDATE");
            $balance->bindParam(':user_name', $name);
            $balance->execute();
            $result = $balance->fetchAll(PDO::FETCH_ASSOC);

            $balanceNum = $result[0]['money'] - $num;

            $inCountData = $this->db->prepare("INSERT INTO `count_action` (`user_name`, `out`, `balance_action`) VALUES (:user_name, :out, :balance_action)");
            $inCountData->bindParam(':user_name', $name);
            $inCountData->bindParam(':out', $num);
            $inCountData->bindParam(':balance_action', $balanceNum);
            $inCountData->execute();

            $inBalanceData = $this->db->prepare("UPDATE `Balance` SET `money` = :money WHERE `user_name` = :user_name");
            $inBalanceData->bindParam(':user_name', $name);
            $inBalanceData->bindParam(':money', $balanceNum);
            $inBalanceData->execute();

            $this->db->commit();

        } catch(Exception $err) {
            $this->db->rollBack();
            $msg = $err->getMessage();
        }

        return true;
    }

    // 寫入存款金額與計算餘額
    function inCount($name, $num)
    {
        try {
            $this->db->beginTransaction();

            $balance = $this->db->prepare("SELECT `money` FROM `Balance` WHERE `user_name` = :user_name FOR UPDATE");
            $balance->bindParam(':user_name', $name);
            $balance->execute();
            $result = $balance->fetchAll(PDO::FETCH_ASSOC);

            $balanceNum = $result[0]['money'] + $num;

            $inCountData = $this->db->prepare("INSERT INTO `count_action` (`user_name`, `in`, `balance_action`) VALUES (:user_name, :in, :balance_action)");
            $inCountData->bindParam(':user_name', $name);
            $inCountData->bindParam(':in', $num);
            $inCountData->bindParam(':balance_action', $balanceNum);
            $inCountData->execute();

            $inBalanceData = $this->db->prepare("UPDATE `Balance` SET `money` = :money WHERE `user_name` = :user_name");
            $inBalanceData->bindParam(':user_name', $name);
            $inBalanceData->bindParam(':money', $balanceNum);
            $inBalanceData->execute();

            $this->db->commit();

        } catch (Exception $err) {
            $this->db->rollBack();
            $msg = $err->getMessage();
        }

        return true;
    }
}
