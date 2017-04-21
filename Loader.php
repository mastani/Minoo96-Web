<?php
defined('ACCESS') or die(header('HTTP/1.1 403 Forbidden'));

require 'Config.php';
require 'Base.php';
require 'Sessions.php';
require 'Libraries/Smarty/Smarty.class.php';

// Set default page's
$page = 'Home';

// Default command is index
$command = 'index';

// We must split current url with slash
// First index is module to be loaded
// Second is the command we must send to the module

// Extract path
$path = array();

if (isset($_GET['path']) && !empty($_GET['path'])) {
    $path[0] = $_GET['path'];

    if (strpos($_GET['path'], '/') !== false) {
        $path = explode('/', $_GET['path']);
    }
}

if (isset($path[0]) && !empty($path[0])) {
    $page = $path[0];
}

// Command can change in specific modules
switch ($page) {
    // In profile module 2nd index is command
    case 'Profile':
        if (isset($path[2]) && !empty($path[2])) {
            $command = $path[2];
        }
        break;
    // In canadmin module 1nd index is command
    case 'candadmin':
        if (isset($path[1]) && !empty($path[1])) {
            $command = 'dashboard';
        }
        break;
    default:
        if (isset($path[1]) && !empty($path[1])) {
            $command = $path[1];
        }
}

// If module doesn't exist then load 404 module
if (!is_dir("Modules/$page/")) {
    $page = '404';
}

BaseController::$page = $page;

// Load module controller
require "Modules/$page/Controller.php";

$controller = new Controller();

require 'Theme/Header.php';
require 'Theme/Body.php';
require 'Theme/Footer.php';
