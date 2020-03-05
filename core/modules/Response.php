<?php


namespace core\modules;


class Response
{
    public static function relocate($path) {
        header("Location: ".$path);
    }
    public static function notfoundHeader() {
        header( "HTTP/1.1 404 Not Found" );
    }

}