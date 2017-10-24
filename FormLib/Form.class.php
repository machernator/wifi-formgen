<?php
namespace FormLib;

/**
 * Rendering und Validierung aller zugehörigen Formularfelder
 * Abhängig von GUMP Validation Library
 */
class Form {
    private $method = '';
    private $action = '';
    private $encType = '';
    private $id = '';
    private $fieldOrder = [];
    private $tagAttributes = [];
    private $fields = []; // FormField Objekte

    /**
     * Konstruktor
     *
     * @param array $conf
     */
    public function __construct(array $conf) {
        // method
        $this->method = 'post';
        if (array_key_exists('method', $conf) && strtolower($conf['method']) === 'get'){
            $this->method = 'get';
        }

        // action
        if (array_key_exists('action', $conf)) {
            $this->action = $conf['action'];
        }

        // id
        if (array_key_exists('id', $conf)) {
            $this->id = $conf['id'];
        }

        // tagAttributes
        if (array_key_exists('tagAttributes', $conf) && is_array($conf['tagAttributes'])){
            $this->tagAttributes = $conf['tagAttributes'];
        }

        // fieldOrder
        if (array_key_exists('fieldOrder', $conf) && is_array($conf['fieldOrder'])){
            $this->fieldOrder = $conf['fieldOrder'];
        }

        // fields
        if (array_key_exists('fields', $conf) &&
            is_array($conf['fields']) &&
            count($conf['fields']) > 0){
            // $this->fields mit FormField Ojbjekten befüllen
            $this->createFields($conf['fields']);
        }
    }

    /**
     * Befüllt $this->fields mit FormField Objekten
     *
     * @param array $fields
     * @return void
     */
    private function createFields(array $fields) {
        // Schleife über alle Felder
        foreach ($fields as $field) {
            /* 
                Alternative zu if/else if, wenn die Anzahl der möglichen
                Werte im Vorhinein bekannt ist.
            */
            switch($field['type']){
                // wenn $field['type'] select ist
                case 'select':
                    $this->fields[ $field['name'] ] = new \FormLib\Select($field);
                    // beende switch
                    break;
                case 'checkbox':
                    $this->fields[ $field['name'] ] = new \FormLib\Checkbox($field);
                    break;
                case 'radio':
                    $this->fields[ $field['name'] ] = new \FormLib\Radio($field);
                    break;
                case 'textarea':
                    $this->fields[ $field['name'] ] = new \FormLib\Textarea($field);
                    break;
                // wenn keiner der vorigen Fälle zutrifft (else)
                default:
                    $this->fields[ $field['name'] ] = new \FormLib\FormField($field);
            }
        }
    }

    /**
     * Formular inkl.   Feldern ausgeben
     *
     * @return string
     */
    public function render() : string {
        $out = $this->renderFormOpen();
        $out .= $this->renderFields();
        $out .= $this->renderFormClose();

        return $out;
    }

    /**
     * Opening form Tag
     *
     * @return string
     */
    public function renderFormOpen() : string {
        $out = '<form' .
                ' method="' . 
                $this->method . 
                '" ' .
                ' action="' . 
                $this->action .
                '"';
               
                if ($this->id !== ''){
                    ' id="' . 
                    $this->id . 
                    '" ';
                }
               
                if ($this->encType !== '') {
                    $out .= ' enctype="' .
                            $this->encType .
                            '"';
                }

                $out .= $this->renderTagAttributes() .
                '>';
        return $out;
    }
    
    /**
     * Closing form Tag
     *
     * @return string
     */
    public function renderFormClose() : string {
        return '</form>';
    }

    /**
     * Alle Formularfelder rendern
     *
     * @return string
     */
    private function renderFields() : string {
        $out = '';
        // Prüfen ob $this->fieldOrder mit genauso vielen Feldern 
        // wie $this->fields befüllt ist.
        if (count($this->fieldOrder) === count($this->fields)) {
            foreach($this->fieldOrder as $fieldName) {
                $out .= $this->fields[$fieldName]->render();
            }
        }
        else {
            // Reihenfolge aus der JSON Datei
            foreach ($this->fields as $field) {
                $out .= $field->render();
            }
        }

        return $out;
    }

    /**
     * Rendering eines Feldes anhand seines Namens
     *
     * @param string $fieldName
     * @return string
     */
    public function renderField(string $fieldName) : string {
        if (!array_key_exists($fieldName, $this->fields)) return '';
        return $this->fields[$fieldName]->render();
    }

    /**
     * Rückgabe eines Feldes anhand seines Namens
     *
     * @param string $fieldName
     * @return FormField
     */
    public function getField(string $fieldName) : FormField {
        if (!array_key_exists($fieldName, $this->fields)) return '';
        return $this->fields[$fieldName];
    }

    private function renderTagAttributes() : string {
        $out = '';
        foreach ($this->tagAttributes as $key => $value) {
            $out .= ' ' .
                    $key .
                    '="' .
                    $value .
                    '"';
        }
        
        return $out;
    }

    /**
     * Validiert die Daten aus $data. Diese haben als Key die Feldnamen. 
     * Im Fehlerfall wird den FormFields die Fehlermeldung bekannt gegeben.
     * 
     * @param array $data
     * @return bool
     */
    public function isValid(array $data) : bool {
        // GUMP initialisieren
        $gump = new GUMP();
        $rules = $this->createValidationArray();
        $gump->validation_rules($rules);

        $filters = $this->createFiltersArray();
        $gump->filter_rules($filters);

        // Validierung
        $validated_data = $gump->run($data);

        if ($validated_data === false) {
            // Fehler traten auf
            $formErrors = $gump->get_errors_array();
            print_r($formErrors);
            return false;
        }
        else {
            return true;
        }


    }

    private function createValidationArray() : array {
        $rules = [];

        // Regeln aus jedem einzelnen Feld auslesen
        foreach($this->fields as $fieldName => $field) {
            $rules[$fieldName] = $field->getValidationRules();
        }

        return $rules;
    }

    private function createFiltersArray() : array {
        return [];
    }
}