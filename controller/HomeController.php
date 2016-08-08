<?php
class HomeController extends Controller{
    function index()
    {
        $sql = $this->model("Payment");
        $data = $sql->findAll();
        $this->view("index", $data);
    }
}