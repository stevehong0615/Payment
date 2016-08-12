<?php

require_once 'myProject/Payment.php';

class PaymentTest extends \PHPUnit_Framework_TestCase
{
    public function testCommit()
    {
        $payment = new Payment;
        $payment->beginTransaction();
        $payment->commit();
    }

    public function testRollBack()
    {
        $payment = new Payment;
        $payment->beginTransaction();
        $payment->rollBack();
    }

    public function testFindAll()
    {
        $userId = 3;

        $payment = new Payment;
        $payment->findAll($userId);
    }

    public function testFindBalance()
    {
        $userId = 3;

        $payment = new Payment;
        $payment->findBalance($userId);
    }

    public function testComputeBalance()
    {
        $userId = 3;
        $money = 3600;

        $payment = new Payment;
        $payment->computeBalance($userId, $money);
    }

    public function testActionAccount()
    {
        $userId = 3;
        $withdraw = 200;
        $deposit = 300;
        $balance = 50000;
        $datetime = "2016-08-12 12:00:00";

        $payment = new Payment;
        $payment->actionAccount($userId, $withdraw, $deposit, $balance, $datetime);
    }
}
