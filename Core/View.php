<?php

namespace Core;

use Exception;

class View
{
    public static function render($path, $args = [])
    {
        extract($args, EXTR_SKIP);
        $fullPath = explode(':', $path);
        $file = null;
        $contentType = $fullPath[0];
        $fileName = $fullPath[1] . '.php';

        if ($contentType == 'component') {
            $file = '../App/Views/templates/components/' . $fileName;
        } elseif ($contentType== 'page') {
            $file = '../App/Views/templates/pages/' . $fileName;
        } elseif ($contentType == 'layout') {
            $file = '../App/Views/templates/layouts/' . $fileName;
        }

        if (is_readable($file)) {
            require $file;
        } else {
            throw new Exception("$file not found");
        }
    }

    public static function renderTemplate($path, $pageTitle, $cssFileName, $args = [], $styles = [])
    {
        extract($args, EXTR_SKIP);

        $layout = '../App/Views/templates/html.php';
        $page = '../App/Views/templates/pages/' . $path . '.php';

        ob_start();
        require $page;
        $content = ob_get_clean();

        require $layout;
    }
}