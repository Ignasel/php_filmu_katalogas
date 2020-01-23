<?php
/**
 * Created by PhpStorm.
 * User: moksleivis
 * Date: 2020-01-22
 * Time: 10:33
 */
$host = "localhost";
$db = 'movies_data';
$username = 'root';
$password = '';
$options = [
    PDO::ATTR_ERRMODE   => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

