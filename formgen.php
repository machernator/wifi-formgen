<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formgen Test</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <style>
    body {
        color: #333;
    }

    h1 {
        text-align: center;
    }
    .wrapper {
        margin: 0 auto;
        width: 90%;
        max-width: 920px;
        border: 1px solid #CCC;
        padding: 1em 1em 3em 1em;
    }
    .form-error {
        color: #900;
    }

    .pure-form fieldset {
        display: block;
        margin-bottom: 1.5em;
        border-radius: 3px;
        border: 1px solid #CCC;
        background-color: transparent;
        padding: 1em;
    }
    .pure-form legend {
        display: inline-block;
        width: auto;
        padding: 0 1em;
        border: 0;
    }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>Test des Formgenerators</h1>

        <?php
        include 'init.inc.php';
        // Formular Konfiguration
        // JSON Datei laden
        $jsonConf = file_get_contents(PROJECT_ROOT . 'inc/formconf.json');
        // zweiter Parameter auf true, wir erhalten assoziatives Array
        $formConf = json_decode($jsonConf, true);

        $myForm = new FormLib\Form($formConf);

        if (isset($_POST)) {
            if (!$myForm->isValid($_POST)) {
                echo $myForm->render();
            }
            else {
                echo 'Vielen Dank für das korrekte Ausfüllen des Formulars';
            }

        }
        else {
            echo $myForm->render();
        }
        ?>
    </div>
</body>
</html>