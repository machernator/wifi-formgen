<?php
require_once '../GUMP/gump.class.php';

function formLibAutoLoad ($className) {
    require_once $className . '.class.php';
}

spl_autoload_register('formLibAutoLoad');

// Formular Konfiguration
// JSON Datei laden
$jsonConf = file_get_contents('inc/formconf.json');
// zweiter Parameter auf true, wir erhalten assoziatives Array
$formConf = json_decode($jsonConf, true);