<?php

namespace core\modules;

use core\modules\View;

class Controller
{
    protected $view;
    protected $view_settings;
    protected $new_settings;

    public function __construct($new_settings = [])
    {
        $this->new_settings = $new_settings;
        $this->view = new View();
        $this->view_settings = require_once "core/config/views.php";
    }
    public function settings($name) {
        $arr = $this->new_settings;
        return array_merge($arr, $this->view_settings[$name]);
    }
}