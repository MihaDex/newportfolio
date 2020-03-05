<?php


namespace core\modules;


class Router
{
    static $controllers_path = 'core\\controllers\\';
    static $not_found = 'Not_found/index';

    public static function run($paths)
    {
        $error = true;
        foreach ($paths as $path=>$controller) {
            $path = '/^' . str_replace('/', '\/', $path) . '$/';
            $uri = $_SERVER['REQUEST_URI'];
            if(strlen($uri) > 1) $uri = rtrim( $_SERVER['REQUEST_URI'],'/');
            if(preg_match($path,$uri, $params)){
                array_shift($params);
                self::loader($controller,$params);
                $error = false;
            }
        }
        if($error) self::loader(self::$not_found,null);
    }
    private static function loader($controller, $params)
    {
        $controller = explode('/', $controller);
        $class_name= $controller[0];
        $method_name = $controller[1];
        $class_name = self::$controllers_path.$class_name;
        $class = new $class_name();
        $class->$method_name($params);
    }

}