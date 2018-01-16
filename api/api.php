<?php

use me\Ratelimited\Panel\UserManager;

/* Set PHP to display errors */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Auto-loader following PHP-FIG PSR-0 Standards
 * Taken from there, by the way.
 */
function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace).DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className).'.php';

    require $fileName;
}

// Register auto-loader
spl_autoload_register('autoload');

switch(htmlentities($_GET['action'])) {
    case('getInt'):
            $manager = new UserManager();
            echo $manager->getInt(htmlentities($_GET['int']));
            break;
}