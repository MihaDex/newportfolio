<?php


namespace core\models;

use core\modules\Model;
use core\modules\Auth;

class User extends Model
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $hash;

    public function register($data) {
        $trigger = false;
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $trigger = true;
            }
        }
        if($data['password'] != $data['confirm_password']) {
            $trigger = true;
        }
        if(!empty($this->getUser($data['email']))) {
            $trigger = true;
        }
        if($trigger) {
            return false;
        } else {
            $this->name = $data['name'];
            $this->email = $data['email'];
            $this->hash = Auth::generateHash();
            $this->password = Auth::generatePassword($this->hash,$data['password']);
            Auth::setUser($this->name, "user");
            return true;
        }
    }

    public function login($data) {
        $trigger = false;
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $trigger = true;
            }
        }
        if($trigger) {
            return false;
        } else {
            $this->email =$data["email"];
            $user = $this->getUser($data["email"]);
            $pass = Auth::generatePassword($user["hash"], $data["password"]);
            if($user["password"] === $pass) {
                Auth::setUser($user["name"], $user["role"]);
                return true;
            } else {
                return false;
            }
        }
    }

}