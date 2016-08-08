<?php

class Controller {
    public function model($model) {
        require_once "model/$model.php";
        return new $model ();
    }
    
    public function css($name) {
        echo '<link rel="stylesheet" href="/Activity/css/'.$name.'.css"/>';
    }
    
    public function script($name) {
        echo '<script src="/Activity/js/'.$name.'.js"></script>';
    }
    
    public function view($view, $data = Array()) {
        require_once "view/$view.php";
    }
}

?>