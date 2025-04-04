<?php

if (!function_exists('debug_log')) {
    /**
     * Guarda una traza en /tmp/symfony_debug.log si APP_DEBUG está activo
     *
     * @param mixed $data Cualquier dato que quieras loguear (string, array, objeto, etc.)
     * @return void
     */
    function debug_log(mixed $data): void
    {
        if ($_ENV['APP_DEBUG'] ?? false) {
            $message = print_r($data, true);
            file_put_contents('/tmp/symfony_debug.log', "[" . date('Y-m-d H:i:s') . "] " . $message . "\n", FILE_APPEND);
        }
    }
}
