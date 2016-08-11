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
        date_default_timezone_set('Asia/Taipei');
        $datetime = date("Y-m-d H:i:s");

        $Payment = $this->model("Payment");

        if (isset($_POST['btnWithDraw'])) {
            $Payment->withdraw($userId, $money, $datetime);

            $this->view("Alert", '成功出款');
            header("refresh:0, url=https://lab-stevehong0615.c9users.io/Payment/");
        }
    }


    // 出款
    function dispensing()
    {
        if (isset($_POST['btn'])) {
            date_default_timezone_set('Asia/Taipei');
            $dateTime = date("Y-m-d H:i:s");
            $dispensingId = $_POST['dispensingId'];
            $num = $_POST['dispensingNumber'];

            $usePaymentModel = $this->model("Payment");
            $data = $usePaymentModel->dispensingModel($dispensingId, $num, $dateTime);

            $this->view("Alert", '成功出款');
            header("refresh:0, url=https://lab-stevehong0615.c9users.io/Payment/");
        }
    }

    // 存款
    function deposit()
    {
        if(isset($_POST['btn'])) {
            date_default_timezone_set('Asia/Taipei');
            $dateTime = date("Y-m-d H:i:s");
            $depositId = $_POST['depositId'];
            $num = $_POST['depositNumber'];

            $usePaymentModel = $this->model("Payment");
            $data = $usePaymentModel->depositModel($depositId, $num, $dateTime);

            $this->view("Alert", '成功存款');
            header("refresh:0, url=https://lab-stevehong0615.c9users.io/Payment/");
        }
    }
}
