<?php
/*
Plugin Name: The Space Access Log CSV
Plugin URI: https://www.thespacesm.com/
Description: This is a plugin to log access to the space and export it as a CSV file.
Version: 1.0.0
Author: The Space
Author URI: https://www.thespacesm.com/
License: GPL2
*/

// Prevent direct file access
defined('ABSPATH') or die('No script kiddies please!');


add_action('init', 'thespace_access_log_csv_init');

function thespace_access_log_csv_init() {

    // check if is defined the variable THESPACE_ACCESS_LOG_CSV_PATH
    if (!defined('THESPACE_ACCESS_LOG_CSV_PATH')) {
        return;
    }
    
    $path = THESPACE_ACCESS_LOG_CSV_PATH;

    if(is_dir($path)){
        return;
    }

    if(!is_writable($path)) {
        return;
    }

    $outputRecord = [
        date('Y-m-d H:i:s'),
        thespace_access_log_csv_get_site_address(),
        thespace_access_log_csv_get_real_ip(),
        thespace_access_log_csv_get_user_agent(),
        thespace_access_log_csv_get_request_path()
    ];

    $output = fopen($path, 'a');
    fputcsv($output, $outputRecord);
    fclose($output);

    //thespace_access_log_csv_rotate_log();
}

function thespace_access_log_csv_rotate_log() {
    $path = THESPACE_ACCESS_LOG_CSV_PATH;

    if(filesize($path) <= 1048576) {
        return;
    }

    $newPathIndex = 0;
    do{
        $newPathIndex++;
        $newPath = str_replace('.csv', sprintf('.%03d.csv', $newPathIndex), $path);
    } while(file_exists($newPath));
    mv($path, $newPath);
}

function thespace_access_log_csv_get_site_address() {
    return get_site_url();
}

function thespace_access_log_csv_get_request_path() {
    return $_SERVER['REQUEST_URI'];
}

function thespace_access_log_csv_get_real_ip() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function thespace_access_log_csv_get_user_agent() {
    return $_SERVER['HTTP_USER_AGENT'];
}