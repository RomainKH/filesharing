<?php

/**
 * SESSION
 */
session_start();

/**
 * Database
 */

// a reconfigurer en fonction du server et de la base de données
define('DB_HOST', 'localhost');
define('DB_PORT', '8888');
define('DB_NAME', 'iwf_fs');
define('DB_USER', 'root');
define('DB_PASS', 'root');

try
{
    $pdo = new PDO(
        'mysql:dbname='.DB_NAME.';host='.DB_HOST.';port='.DB_PORT,
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
}
catch(PDOException $e)
{
    die('Cannot connect');
}
