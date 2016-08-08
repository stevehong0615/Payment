<?php
class Payment extends Connect{
    function findAll()
    {
        $balance = $this->db->prepare("SELECT * FROM `count_action`");
        $balance->execute();
        $result = $balance->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}