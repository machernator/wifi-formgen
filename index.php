<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Generator</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
</head>
<body>
    <h1>Form Generator</h1>
    <?php
    require_once 'inc/FormField.class.php';
    require_once 'inc/init.inc.php';

    // Alle Formularfelder
    $fields = [
        "username" => [
            "name" => "username",
            "id" => "userName",
            "label" => "Name",
            "type" => "text",
            "dataType" => "alnum",
            "minLen" => 3,
            "tagAttributes" => [
                "class" => "form-field",
                "placeholder" => "Ihr Name",
                // "onclick" => "alert('Jipie')"
            ]
        ],
        "password" => [
            "name" => "password",
            "id" => "passWord",
            "label" => "Passwort",
            "type" => "password",
            "dataType" => "alnum",
            "minLen" => 8
        ],
        "erfahrenwie" => [
            "name" => "erfahrenwie",
            "id" => "erfahreWie",
            "label" => "Wie haben Sie von uns erfahren?",
            "type" => "radio",
            "dataType" => "whitelist",
            "value" => "tv",
            "values" => [
                "zeitung" => "Zeitung",
                "onlinewerbung" => "Online Werbung",
                "radio" => "Radio",
                "tv" => "TV Spot",
                "sonstige" => "Sonstige"
            ]
        ],
        "titel" => [
            "name" => "titel",
            "id" => "titel",
            "label" => "Titel",
            "type" => "select",
            "dataType" => "whitelist",
            "value" => ["dr", "master"],
            "values" => [
                "mag" => "Magister",
                "master" => "Master",
                "bachelor" => "Bachelor",
                "dr" => "Dr."
            ],
            "tagAttributes" => [
                "multiple" => true
            ]

        ]
    ];

    $fieldsJson = json_encode($fields);
    echo '<pre>';
    print_r($fieldsJson);
    echo '</pre>';

    /* Ziel:
        $f = new Form($conf);
        $f->render();
    */
    ?>
    <form action="" method="post" class="pure-form pure-form-stacked">
        <?php
        $userName = new \FormLib\FormField($fields['username']);
        echo $userName->render();

        $password = new \FormLib\Textarea($fields['password']);
        echo $password->render();

        $titel = new \FormLib\Select($fields['titel']);
        // Feld validieren ... 
        $titelError = 'Ui, falsch!';
        $titel->setError($titelError);
        echo $titel->render();

        $radios = new \FormLib\Radio($fields['erfahrenwie']);
        echo '<div id="' . $fields['erfahrenwie']['id'] . '">'; 
        echo $radios->render();
        echo '</div>';
        /* echo $password->renderLabel();
        echo '<p>blabla</p>';
        echo $password->renderField(); */

        
        /* echo "<pre>";
        print_r($userName);
        echo "</pre>"; */
        
        /* 
            Ergebnis:
            <label for="userName">Name</label>
            <input type="text" name="userName" id="userName" class="form-field" placeholder="Ihr Name">
        */
        ?>
    </form>
</body>
</html>