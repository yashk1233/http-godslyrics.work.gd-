<?php

if (!function_exists('print_rr')) {
    /**
     * Format a date in a custom format.
     *
     * @param  string  $date
     * @param  string  $format
     * @return string
     */
    function print_rr($data) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';exit;
    }
}
