<?php

class HomeController extends Controller
{
    // 主頁
    function index()
    {
        $this->view("Index");
    }

    // 明細查詢
    function detail()
    {
        $userId = $_POST['userId'];

        $payment = $this->model("Payment");
        $detail = $payment->findAll($userId);

        $this->view("Detail", $detail);
    }

    // 查詢目前餘額
    function balance()
    {
        $userId = $_POST['userId'];

        $payment = $this->model("Payment");
        $balance = $payment->findBalance($userId);

        $this->view("Balance", $balance);
    }

    // 執行出款、存款
    function accountAction()
    {
        $userId = $_POST['userId'];
        date_default_timezone_set('Asia/Taipei');
        $datetime = date("Y-m-d H:i:s");

        $payment = $this->model("Payment");

        if (isset($_POST['btnWithDraw'])) {
            $balance = $payment->findBalance($userId);

            if ($balance[0]['money'] < $money) {
                $this->view("Alert", '餘額不足');
                header("refresh:0, url=https://lab-stevehong0615.c9users.io/Payment/");
            }

            if ($balance[0]['money'] >= $money) {
                $withdraw = $_POST['money'];
                $deposit = null;
                $money = "-" . $withdraw;

                $payment->computeBalance($userId, $money);
                $balance = $payment->findBalance($userId);
                $balance = $balance[0]['money'];
                $payment->actionAccount($userId, $withdraw, $deposit, $balance, $datetime);

                $this->view("Alert", '成功出款');
                header("refresh:0, url=https://lab-stevehong0615.c9users.io/Payment/");
            }
        }

        if (isset($_POST['btnDeposit'])) {
            $deposit = $_POST['money'];
            $withdraw = null;

            $payment->computeBalance($userId, $deposit);
            $balance = $payment->findBalance($userId);
            $balance = $balance[0]['money'];
            $payment->actionAccount($userId, $withdraw, $deposit, $balance, $datetime);

            $this->view("Alert", '成功存款');
            header("refresh:0, url=https://lab-stevehong0615.c9users.io/Payment/");
        }
    }
}
