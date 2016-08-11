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

        $Payment = $this->model("Payment");
        $detail = $Payment->findAll($userId);

        $this->view("Detail", $detail);
    }

    // 查詢目前餘額
    function balance()
    {
        $userId = $_POST['userId'];

        $Payment = $this->model("Payment");
        $balance = $Payment->findBalance($userId);

        $this->view("Balance", $balance);
    }

    // 執行出款、存款
    function accountAction(){
        $userId = $_POST['userId'];
        $money = $_POST['money'];
        $emptyMoney = null;
        date_default_timezone_set('Asia/Taipei');
        $datetime = date("Y-m-d H:i:s");

        $Payment = $this->model("Payment");

        if (isset($_POST['btnWithDrawal'])) {
            $balance = $Payment->findBalance($userId);

            if ($balance[0]['money'] < $money) {
                $this->view("Alert", '餘額不足');
                header("refresh:0, url=https://lab-stevehong0615.c9users.io/Payment/");
            }

            if ($balance[0]['money'] >= $money) {
                $judgmentMoney = "-" . $money;
                $Payment->actionAccount($userId, $money, $emptyMoney, $datetime, $judgmentMoney);

                $this->view("Alert", '成功出款');
                header("refresh:0, url=https://lab-stevehong0615.c9users.io/Payment/");
            }
        }

        if (isset($_POST['btnDeposit'])) {
            $judgmentMoney = $money;
            $Payment->actionAccount($userId, $money, $emptyMoney, $datetime, $judgmentMoney);

            $this->view("Alert", '成功存款');
            header("refresh:0, url=https://lab-stevehong0615.c9users.io/Payment/");
        }
    }
}
