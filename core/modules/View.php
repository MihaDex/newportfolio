<?php

namespace core\modules;

class View
{
    private $views_path = "/views/";

    public function render($view, $settings)
    {
        $this->loader($view, $settings);
    }

    private function loader($view, $settings){
        if(is_array($settings)) extract($settings);

        $view = explode('/', $view);
        $path = DIRECTORY.str_replace('/', DIRECTORY_SEPARATOR, $this->views_path.$view[0]).DIRECTORY_SEPARATOR;

        $content_path = $path.$view[1].".php";
        $layout_path = $path."layout.php";

        $content = "";
        $layout = "";

        if(file_exists($content_path)) {
            ob_start();
            include $content_path;
            $content = ob_get_contents();
            ob_end_clean();
        }

        if(file_exists($layout_path)) {
            ob_start();
            include $layout_path;
            return ob_get_contents();
        }






    }
}