<?php

class Payment extends Connect
{
    // 抓取全部明細
    function findAll($userId)
    {
        $sqlDetail = "SELECT *
            FROM `account_details`
            WHERE `user_id` = :user_id";
        $detail = $this->db->prepare($sqlDetail);
        $detail->bindParam(':user_id', $userId);
        $detail->execute();
        $result = $detail->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // 查詢目前餘額
    function findBalance($userId)
    {
        $sqlBalance = "SELECT *
            FROM `balance`
            WHERE `user_id` = :user_id";
        $balance = $this->db->prepare($sqlBalance);
        $balance->bindParam(':user_id', $userId);
        $balance->execute();
        $result = $balance->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // 修改目前餘額
    function updateBalance($userId, $balance){
        $sqlUpdateBalance ="UPDATE `balance`
            SET `money` = :money
            WHERE `user_id` = :user_id";
        $updateBalance = $this->db->prepare($sqlUpdateBalance);
        $updateBalance->bindParam(':user_id', $userId);
        $updateBalance->bindParam(':money', $balance);
        $updateBalance->execute();

        return true;
    }

    // 出款、存款
    function actionAccount($userId, $money, $emptyMoney, $datetime, $judgmentMoney)
    {
        try{
            $this->db->beginTransaction();
            $result = $this->findBalance($userId);

            $balance = $result[0]['money'] + $judgmentMoney;

            if ($judgmentMoney < 0) {
                $sqlAddDetail = "INSERT INTO `account_details` (`user_id`, `withdraw`, `deposit`, `balance`, `datetime`)
                    VALUES (:user_id, :withdraw, :deposit, :balance, :datetime)";
                $addDetail = $this->db->prepare($sqlAddDetail);
                $addDetail->bindParam(':user_id', $userId);
                $addDetail->bindParam(':withdraw', $money);
                $addDetail->bindParam(':deposit', $emptyMoney);
                $addDetail->bindParam(':balance', $balance);
                $addDetail->bindParam(':datetime', $datetime);
                $addDetail->execute();
            }

            if ($judgmentMoney > 0) {
                $sqlAddDetail = "INSERT INTO `account_details` (`user_id`, `withdraw`, `deposit`, `balance`, `datetime`)
                    VALUES (:user_id, :withdraw, :deposit, :balance, :datetime)";
                $addDetail = $this->db->prepare($sqlAddDetail);
                $addDetail->bindParam(':user_id', $userId);
                $addDetail->bindParam(':withdraw', $emptyMoney);
                $addDetail->bindParam(':deposit', $money);
                $addDetail->bindParam(':balance', $balance);
                $addDetail->bindParam(':datetime', $datetime);
                $addDetail->execute();
            }

            $this->updateBalance($userId, $balance);

            $this->db->commit();

        } catch (Exception $err) {
            $this->db->rollBack();
            $msg = $err->getMessage();
        }

        return true;
    }
}
