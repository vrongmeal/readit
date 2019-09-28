<?php

class DB {
    private static $instance;

    public static function get_instance() {
        if (!self::$instance) {
            self::$instance = new PDO("mysql:host=51.158.118.84;port=33060;dbname=readit", "vrongmeal", "password");
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }
}
