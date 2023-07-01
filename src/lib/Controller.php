<?php

namespace Ecasa\Instagram\lib;
use Ecasa\Instagram\lib\View;

class Controller{

    private View $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function render(string $name, array $data =[])
    {
        $this->view->render($name, $data);
    }

    protected function post(string $param)
    {
        if(!isset($_POST[$param]))
        {
            return null;
        }

        return$_POST[$param];
    }

    protected function get(string $param)
    {
        if(!isset($_GET[$param]))
        {
            return null;
        }
        return $_GET[$param];
    }

    protected function file(string $param)
    {
        if(!isset($_FILES[$param]))
        {
            return null;
        }
        return $_FILES[$param];
    }
}