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

        $sql = $this->model("Payment");
        $data = $sql->findAll($detailName);

        $this->view("detail", $data);
    }

    // 出款
    function outMoney()
    {
        if (isset($_POST['btn'])) {
            $name = $_POST['outName'];
            $num = $_POST['outNumber'];

            $sql = $this->model("Payment");
            $data = $sql->outCount($name, $num);

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

            $sql = $this->model("Payment");
            $data = $sql->inCount($name, $num);

            $this->view("alert", '成功存款');
            header("refresh:0, url=https://lab-stevehong0615.c9users.io/Payment/");
        }
    }
}
