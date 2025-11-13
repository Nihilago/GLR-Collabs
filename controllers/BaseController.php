<?php
class BaseController {

    protected $baseUrl;

    public function __construct()
    {
        // Dynamisch bepalen op runtime
        $this->baseUrl = '/' . trim(dirname($_SERVER['SCRIPT_NAME']), '/');

        // Root-case: dirname('/') = '.' → correcten
        if ($this->baseUrl === '/.') {
            $this->baseUrl = '/';
        }
    }

    protected function render($view, $data = [])
    {
        extract($data);

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

        // Correct samenstellen
        $base = rtrim($this->baseUrl, '/');
        $path = '/' . ltrim($url, '/');

        header("Location: {$base}{$path}");
        exit;
    }

    protected function json($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}
