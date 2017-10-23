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
            echo $this->fields[ $value['name'] ]->render();
            echo '<br>';
        }

    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function render() : string {

    }

    /**
     * Undocumented function
     *
     * @param string $fieldName
     * @return string
     */
    public function renderField(string $fieldName) : string {

    }

    /**
     * Undocumented function
     *
     * @param string $fieldName
     * @return FormField
     */
    public function getField(string $fieldName) : FormField {

    }
}