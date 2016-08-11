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
            WHERE `user_id` = :user_id FOR UPDATE";
        $balance = $this->db->prepare($sqlBalance);
        $balance->bindParam(':user_id', $userId);
        $balance->execute();
        $result = $balance->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // 計算餘額
    function computeBalance($userId, $money)
    {
        $sqlBalance = "UPDATE `balance`
            SET `money` = `money` + :money
            WHERE `user_id` = :user_id";
        $updateBalance = $this->db->prepare($sqlBalance);
        $updateBalance->bindParam(':user_id', $userId);
        $updateBalance->bindParam(':money', $money);
        $updateBalance->execute();

        return true;
    }

    // 出款、存款
    function actionAccount($userId, $withdraw, $deposit, $balance, $datetime)
    {
        try{
            $this->db->beginTransaction();

            $sqlAddDetail = "INSERT INTO `account_details`
                (`user_id`, `withdraw`, `deposit`, `balance`, `datetime`)
                VALUES (:user_id, :withdraw, :deposit, :balance, :datetime)";
            $addDetail = $this->db->prepare($sqlAddDetail);
            $addDetail->bindParam(':user_id', $userId);
            $addDetail->bindParam(':withdraw', $withdraw);
            $addDetail->bindParam(':deposit', $deposit);
            $addDetail->bindParam(':balance', $balance);
            $addDetail->bindParam(':datetime', $datetime);
            $addDetail->execute();

            $this->db->commit();

        } catch (Exception $err) {
            $this->db->rollBack();
            $msg = $err->getMessage();
        }

        return true;
    }
}
