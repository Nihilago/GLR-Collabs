<?php

class BaseController
{

    // Dynamisch de BASE_URL vaststellen
    protected const BASE_URL =
    '/' . trim(dirname($_SERVER['SCRIPT_NAME']), '/');

    protected function render($view, $data = [])
    {
        extract($data);

        // Correct absoluut pad
        $viewFile = __DIR__ . "/../views/{$view}.php";

        if (!file_exists($viewFile)) {
            throw new Exception("View not found: {$viewFile}");
        }

        ob_start();
        include $viewFile;
        echo ob_get_clean();
    }

    protected function redirect($url)
    {
        // Absolute URL (http/https)
        if (preg_match('#^https?://#', $url)) {
            header("Location: $url");
            exit;
        }

        // Zorg dat BASE_URL geen dubbele slash geeft
        $base = rtrim(self::BASE_URL, '/');
        $url  = '/' . ltrim($url, '/');

        header("Location: {$base}{$url}");
        exit;
    }

    protected function json($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
