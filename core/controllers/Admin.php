<?php

namespace core\controllers;

use core\modules\Controller;
use core\models\User;
use core\modules\Request;
use core\modules\Auth;
use core\modules\Response;

class Admin extends Controller
{
    public function __construct()
    {
        if(Auth::isAdmin()) {
            parent::__construct(["user" => Auth::getUser(), "msg" => Auth::getFlash()]);
        } else {
            Response::relocate("/login");
        }
    }

    public function index(){
        $this->view->render('admin/index', $this->settings('admin'));
    }
}