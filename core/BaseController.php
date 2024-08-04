<?php

require_once 'Template.php';

class BaseController
{
    protected $template;

    public function __construct()
    {
        $this->template = new Template();
    }

    public function view($view, $data = [])
    {
        echo $this->template->render($view, $data);
    }

    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }
}
