<?php

// __FILE__

class File {
    public static function FILENAME($file) {
        // Example: test
        $path_parts = pathinfo($file);
        return $path_parts['filename'];
    }

    public static function DIRNAME($file) {
        // Example: /var/www/html
        $path_parts = pathinfo($file);
        return $path_parts['dirname'];
    }

    public static function BASENAME($file) {
        // Example: test.php
        $path_parts = pathinfo($file);
        return $path_parts['basename'];
    }

    public static function EXTENSION($file) {
        // Example: php
        $path_parts = pathinfo($file);
        return $path_parts['extension'];
    }
}

