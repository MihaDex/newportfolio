<?php

namespace core\controllers;

use core\modules\Auth;
use core\modules\Controller;
use core\modules\Response;


class Not_found extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->new_settings = ["user"=>Auth::getUser()];
    }
    function index(){
        Response::notfoundHeader();
        $this->view->render('home/notfound', $this->settings('notfound'));
    }
}