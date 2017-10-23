<?php
function formLibAutoLoad ($className) {
    require_once $className . '.class.php';
}

spl_autoload_register('formLibAutoLoad');