<?php
class Session {
    protected const BASE_URL = '/collabs/';

    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $value) {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        self::start();
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function destroy() {
        self::start();
        session_destroy();
    }

    public static function isLoggedIn() {
        return self::get('user_id') !== null;
    }

    public static function requireLogin() {
        if (!self::isLoggedIn()) {
            header('Location: ' . self::BASE_URL . 'login');
            exit();
        }
    }

    public static function redirectIfLoggedIn() {
        if (self::isLoggedIn()) {
            header('Location: ' . self::BASE_URL . 'dashboard');
            exit();
        }
    }
}
?>
