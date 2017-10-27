<?php
define ('PROJECT_ROOT', __DIR__ . '/');

require_once 'GUMP/gump.class.php';

function formLibAutoLoad ($className) {
	// Unix/Linux
    $fileName = PROJECT_ROOT . '/' .  str_replace('\\', '/', $className) . ".class.php";

    // Windows
    // $fileName = __DIR__ . '\\' .  $className . '.class.php';
    //
    if(file_exists($fileName)) {
        require_once($fileName);
    }
}

spl_autoload_register('formLibAutoLoad');