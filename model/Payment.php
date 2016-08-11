<?php

class Payment extends Connect
{
    // 抓取全部明細
    function findAll($userId)
    {
        $sqlDetail = "SELECT *
                    FROM `account_details`
                    WHERE `user_id` = :user_id";
        $detail = $this->db->prepare($sqlBalance);
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

    // 寫入出款金額與計算餘額
    function dispensingModel($dispensingId, $num, $dateTime)
    {
        try {
            $this->db->beginTransaction();

            $sqlBalance = "SELECT `money`
                        FROM `Balance`
                        WHERE `user_id` = :user_id FOR UPDATE";
            $balance = $this->db->prepare($sqlBalance);
            $balance->bindParam(':user_id', $dispensingId);
            $balance->execute();
            $result = $balance->fetchAll(PDO::FETCH_ASSOC);

            $balanceNum = $result[0]['money'] - $num;

            $sqlAddDetail = "INSERT INTO `Account_Details` (`user_id`, `dispensing`, `balance_action`, `time`)
                            VALUES (:user_id, :dispensing, :balance_action, :time)";
            $inCountData = $this->db->prepare($sqlAddDetail);
            $inCountData->bindParam(':user_id', $dispensingId);
            $inCountData->bindParam(':dispensing', $num);
            $inCountData->bindParam(':balance_action', $balanceNum);
            $inCountData->bindParam(':time', $dateTime);
            $inCountData->execute();

            $sqlBalanceModified ="UPDATE `Balance`
                                SET `money` = :money
                                WHERE `user_id` = :user_id";
            $inBalanceData = $this->db->prepare($sqlBalanceModified);
            $inBalanceData->bindParam(':user_id', $dispensingId);
            $inBalanceData->bindParam(':money', $balanceNum);
            $inBalanceData->execute();

            $this->db->commit();

        } catch (Exception $err) {
            $this->db->rollBack();
        }

        return true;
    }

    // 寫入存款金額與計算餘額
    function depositModel($depositId, $num, $dateTime)
    {
        try {
            $this->db->beginTransaction();

            $sqlBalance = "SELECT `money`
                        FROM `Balance`
                        WHERE `user_id` = :user_id FOR UPDATE";
            $balance = $this->db->prepare($sqlBalance);
            $balance->bindParam(':user_id', $depositId);
            $balance->execute();
            $result = $balance->fetchAll(PDO::FETCH_ASSOC);

            $balanceNum = $result[0]['money'] + $num;

            $sqlAddDetail = "INSERT INTO `Account_Details` (`user_id`, `deposit`, `balance_action`, `time`)
                            VALUES (:user_id, :deposit, :balance_action, :time)";
            $inCountData = $this->db->prepare($sqlAddDetail);
            $inCountData->bindParam(':user_id', $depositId);
            $inCountData->bindParam(':deposit', $num);
            $inCountData->bindParam(':balance_action', $balanceNum);
            $inCountData->bindParam(':time', $dateTime);
            $inCountData->execute();

            $sqlBalanceModified = "UPDATE `Balance`
                                SET `money` = :money
                                WHERE `user_id` = :user_id";
            $inBalanceData = $this->db->prepare($sqlBalanceModified);
            $inBalanceData->bindParam(':user_id', $depositId);
            $inBalanceData->bindParam(':money', $balanceNum);
            $inBalanceData->execute();

            $this->db->commit();

        } catch (Exception $err) {
            $this->db->rollBack();
        }

        return true;
    }
}
