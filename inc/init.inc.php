<?php
define ('DOCROOT', dirname(__FILE__));
require_once 'GUMP/gump.class.php';

function formLibAutoLoad ($className) {
	// Unix/Linux
    $fileName = __DIR__ . '/../' .  str_replace('\\', '/', $className) . ".class.php";

    // Windows
    // $fileName = __DIR__ . '\\' .  $className . '.class.php';
    //
    if(file_exists($fileName)) {
        require_once($fileName);
    }
}

spl_autoload_register('formLibAutoLoad');

// Formular Konfiguration
// JSON Datei laden
$jsonConf = file_get_contents('inc/formconf.json');
// zweiter Parameter auf true, wir erhalten assoziatives Array
$formConf = json_decode($jsonConf, true);