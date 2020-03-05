<?php


namespace core\modules;


class Auth
{
    public static function startSession() {
        session_start();
        if(isset($_SESSION['flash']) && isset($_SESSION['flash_count'])) {
            $_SESSION['flash_count'] = $_SESSION['flash_count'] +1;
            if($_SESSION['flash_count'] > 1) {
                unset($_SESSION['flash']);
                unset($_SESSION['flash_count']);
            }
        }
    }
    public static function generateHash($length = 8) {
        $chars = "abdefhiknrstyzABDEFGHKNQRSTYZ23456789";
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }
    public static function generatePassword($hash, $pass) {
        return md5(md5($pass).md5($hash));
    }

    public static function setUser($user, $role) {
        $_SESSION["user"] = $user;
        $_SESSION["role"] = $role;
    }

    public static function getUser() {
        if(!empty($_SESSION["user"])) {
            return $_SESSION["user"];
        } else {
            return false;
        }
    }

    public static function isAdmin() {
        if (!empty($_SESSION["user"]) && !empty($_SESSION["role"]) && $_SESSION["role"] == "admin") {
            return true;
        } else return false;
    }

    public static function flashMessage($msg) {
        $_SESSION['flash'] = $msg;
        $_SESSION['flash_count'] = 0;
    }

    public static function getFlash() {
        if(!empty($_SESSION['flash'])) {
            return $_SESSION['flash'];
        } else return false;
    }

    public static function logout() {
        session_start();
        session_unset();
        session_destroy();
    }
}