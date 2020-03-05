<?php


namespace core\modules;


class Request
{
    public static function post(){
        return $_POST;
    }

    public static function get(){
        return $_GET;
    }

}