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
            $data = $sql->takeCount($num);
            // $this->view("alert", '已出款');
            // header("refresh:0, url:https://lab-stevehong0615.c9users.io/Payment/");
        }
    }
}