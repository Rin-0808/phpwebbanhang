<?php
class SessionHelper {
    public static function init() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function isAdmin() {
        self::init();
        return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    }

    public static function isLoggedIn() {
        self::init();
        return isset($_SESSION['user_id']);
    }

    public static function getUserId() {
        self::init();
        return $_SESSION['user_id'] ?? null;
    }

    public static function getRole() {
        self::init();
        return $_SESSION['role'] ?? 'guest';
    }

    public static function set($key, $value) {
        self::init();
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        self::init();
        return $_SESSION[$key] ?? null;
    }
}
?>