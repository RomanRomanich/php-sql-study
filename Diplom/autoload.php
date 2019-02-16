<?php
function models($className)
{
    $className = str_replace('\\', '/', $className);
    if (is_readable('./files/' . $className . '.php')) {
        $file = 'files/' . $className . '.php';
        require_once($file);
    } elseif (is_readable('./files/src/' . $className . '.php')) {
        $file = './files/src/' . $className . '.php';
        require_once($file);
    } elseif (is_readable('./files/' . $className . '.php')) {
        $file = './files/' . $className . '.php';
        require_once($file);
    }
}
require_once('./files/Controllers/AdminController.php');
require_once('./files/Controllers/UserController.php');

spl_autoload_register('models');
