<?php
class Controller
{
    public function model($model)
    {
        require_once "model/$model.php";
        return new $model ();
    }

    public function view($view, $data = array())
    {
        require_once "view/$view.php";
    }
}
