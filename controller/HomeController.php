<?php

class HomeController extends Controller
{
    // 主頁
    function index()
    {
        $this->view("Index");
    }

    // 明細查詢
    function allList()
    {
        $detailName = $_POST['detailId'];

        $usePaymentModel = $this->model("Payment");
        $data = $usePaymentModel->findAll($detailName);

        $this->view("Detail", $data);
    }

    // 查詢目前餘額
    function accountInquire()
    {
        $userId = $_POST['userId'];

        if (isset($_POST['btnDetail'])) {
            $Payment = $this->model("Payment");
            $detailData = $Payment->findAll($userId);

            $this->view("Detail", $detailData);
        }

        if (isset($_POST['btnBalance'])) {
            $Payment = $this->model("Payment");
            $balanceData = $Payment->findBalance($userId);

            $this->view("Balance", $balanceData);
        }
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
            $judgmentMoney = "-" . $money;
            $Payment->actionAccount($userId, $money, $emptyMoney, $datetime, $judgmentMoney);

            $this->view("Alert", '成功出款');
            header("refresh:0, url=https://lab-stevehong0615.c9users.io/Payment/");
        }
        if (isset($_POST['btnDeposit'])) {
            $judgmentMoney = $money;
            $Payment->actionAccount($userId, $money, $emptyMoney, $datetime, $judgmentMoney);

            $this->view("Alert", '成功存款');
            header("refresh:0, url=https://lab-stevehong0615.c9users.io/Payment/");
        }
    }
}
