<?php

class Autoloader
{
   const NAMESPACE_PREFIX = 'core';

   public static function register()
   {
       spl_autoload_register(array(new self, 'autoload'));
   }

   public static function autoload($class)
   {
       $prefixLength = strlen(self::NAMESPACE_PREFIX);
       if (0 === strncmp(self::NAMESPACE_PREFIX, $class, $prefixLength)) {
           $file = str_replace('\\', DIRECTORY_SEPARATOR, substr($class, $prefixLength));
           $file =  realpath(__DIR__ . (empty($file) ? '' : DIRECTORY_SEPARATOR . '..') . $file . '.php');

           if(file_exists($file)) {
               require_once $file;
           }
       }
   }

}