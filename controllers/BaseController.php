<?php
class BaseController {

    protected const BASE_URL = '/collabs/';

    protected function render($view, $data = []) {
        // Extract data array to variables
        extract($data);

        // Start output buffering
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
        header("Location: {$url}");
        exit();
    }

    protected function json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}
?>
