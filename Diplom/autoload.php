<?php
function models($className)
{
    $file = 'files/models/'. lcfirst($className) . '.php';
    if (is_readable($file)) {
        require_once ($file);
    }
}
require_once ('./files/controllers/admin/control.php');
require_once ('./files/controllers/user/control.php');
spl_autoload_register('models');
