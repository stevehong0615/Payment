<?php

class HomeController extends Controller
{
    // 主頁
    function index()
    {
        $this->view("index");
    }

    // 明細查詢
    function allList()
    {
        $detailName = $_POST['detailName'];

        $usePaymentModel = $this->model("Payment");
        $data = $usePaymentModel->findAll($detailName);

        $this->view("detail", $data);
    }

    // 出款
    function outMoney()
    {
        if (isset($_POST['btn'])) {
            $name = $_POST['outName'];
            $num = $_POST['outNumber'];

            $usePaymentModel = $this->model("Payment");
            $data = $usePaymentModel->outCount($name, $num);

            $this->view("alert", '成功出款');
            header("refresh:0, url=https://lab-stevehong0615.c9users.io/Payment/");
        }
    }

    // 存款
    function inMoney()
    {
        if(isset($_POST['btn'])) {
            $name = $_POST['inName'];
            $num = $_POST['inNumber'];

            $usePaymentModel = $this->model("Payment");
            $data = $usePaymentModel->inCount($name, $num);

            $this->view("alert", '成功存款');
            header("refresh:0, url=https://lab-stevehong0615.c9users.io/Payment/");
        }
    }
}
