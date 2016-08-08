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
            header("location:/Payment/");
        }
    }
}