<?php

namespace core\controllers;

use core\modules\Controller;
use core\models\User;
use core\modules\Request;
use core\modules\Auth;
use core\modules\Response;

class Home extends Controller
{
    public function __construct()
    {
        parent::__construct(["user" => Auth::getUser(), "msg" => Auth::getFlash()]);
    }

    public function index(){
        $this->view->render('home/main', $this->settings('home'));
    }
    public function register(){
        if(empty(Request::post())) {
            $this->view->render('home/register', $this->settings('register'));
        } else {
            $user =  new User();
            if($user->register(Request::post())) {
                if($user->insert()) {
                    Response::relocate("/admin");
                }
            } else {
                Auth::flashMessage("Ошибка регистрации");
                Response::relocate("/register");
            }
        }
    }
    public function login() {
        if(empty(Request::post())) {
            $this->view->render('home/login', $this->settings('login'));
        } else {
            $user = new User();
            if($user->login(Request::post())) {
                Response::relocate("/admin");
            } else {
                Auth::flashMessage("Ошибка авторизации!");
                Response::relocate("/login");
            }
        }
    }
    public function logout() {
        Auth::logout();
        Response::relocate("/");
    }
    public function works() {
        $this->view->render('home/works', $this->settings('works'));
    }
}