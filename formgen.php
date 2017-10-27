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
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>Test des Formgenerators</h1>

        <?php
        // error_reporting(E_ALL); ini_set('display_errors', 1);
        include 'inc/init.inc.php';
        $myForm = new FormLib\Form($formConf);
        $dummyData = [
            'anrede' => 'w',
            'vorname' => 'Thomas',
            'nachname' => 122321
        ];

        $myForm->isValid($dummyData);
        echo $myForm->render();
        ?>
    </div>
</body>
</html>