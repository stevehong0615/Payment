<?php
class HomeController extends Controller{
    // 主頁 & 帳目明細
    function index()
    {
        $sql = $this->model("Payment");
        $data = $sql->findAll();
        $this->view("index", $data);
    }
    
    // 出款
    function outMoney()
    {
        if(isset($_POST['btn'])) {
            $num = $_POST['outNumber'];
            $sql = $this->model("Payment");
            $data = $sql->outCount($num);
            header("location:/Payment/");
        }
    }
    
    // 存款
    function inMoney()
    {
        if(isset($_POST['btn'])) {
            $num = $_POST['inNumber'];
            $sql = $this->model("Payment");
            $data = $sql->inCount($num);
            header("location:/Payment/");
        }
    }
}