<?php

class DB {
    private static $instance;

    public static function get_instance() {
        if (!self::$instance) {
            self::$instance = new PDO("mysql:host=localhost;dbname=readit", "root", "password");
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }
}
