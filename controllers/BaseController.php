<?php
class BaseController {

<<<<<<< HEAD
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

=======
    protected const BASE_URL = '/collabs/';

    protected function render($view, $data = []) {
        // Extract data array to variables
        extract($data);

        // Start output buffering
>>>>>>> parent of 7c4b79f (fixed broken router and incorrect communication between apache and BaseController)
        ob_start();

        // Include the view file
        include "views/{$view}.php";

        // Get the content
        $content = ob_get_contents();
        ob_end_clean();

        // Return or echo the content
        echo $content;
    }

    protected function redirect($url) {
        // Check if URL is an absolute URL or already contains BASE_URL
        if (strpos($url, 'http') !== 0 && strpos($url, self::BASE_URL) !== 0) {
            $url = self::BASE_URL . ltrim($url, '/');
        }
<<<<<<< HEAD

        // Correct samenstellen
        $base = rtrim($this->baseUrl, '/');
        $path = '/' . ltrim($url, '/');

        header("Location: {$base}{$path}");
        exit;
=======
        header("Location: {$url}");
        exit();
>>>>>>> parent of 7c4b79f (fixed broken router and incorrect communication between apache and BaseController)
    }

    protected function json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}
?>
