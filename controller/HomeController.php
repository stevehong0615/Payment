<?php
class HomeController extends Controller{
    
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