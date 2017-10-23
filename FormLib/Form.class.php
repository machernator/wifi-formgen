<?php
namespace FormLib;

/**
 * Rendering und Validierung aller zugehörigen Formularfelder
 */
class Form {
    private $method = '';
    private $action = '';
    private $encType = '';
    private $id = '';
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
        foreach ($fields as $value) {
            /* 
                Alternative zu if/else if, wenn die Anzahl der möglichen
                Werte im Vorhinein bekannt ist.
            */
            switch($value['type']){
                // wenn $value['type'] select ist
                case 'select':
                    $this->fields[ $value['name'] ] = new \FormLib\Select($value);
                    // beende switch
                    break;
                case 'checkbox':
                    $this->fields[ $value['name'] ] = new \FormLib\Checkbox($value);
                    break;
                case 'radio':
                    $this->fields[ $value['name'] ] = new \FormLib\Radio($value);
                    break;
                case 'textarea':
                    $this->fields[ $value['name'] ] = new \FormLib\Textarea($value);
                    break;
                // wenn keiner der vorigen Fälle zutrifft (else)
                default:
                    $this->fields[ $value['name'] ] = new \FormLib\FormField($value);
            }

        }
    }

    /* public function render() : string {
        // Form Öffnen-Tag erstellen
        $out = '<form method="' .
                $this->method .
                '" action="' .
                $this->action .
                '" id="' .
                $this->id .
                '"' .
                $this->renderTagAttributes() .
                '>';

        // Felder erstellen
        foreach($this->fields as $field) {
            $out .= $field->render();
        }

        // Form Tag schließen
        $out .= '</form>';
        return $out;
    } */

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
        foreach ($this->fields as $field) {
            $out .= $field->render();
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
}