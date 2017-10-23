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
        if (array_key_exists('id', $conf) && $conf['id'] !== '') {
            $this->id = $conf['id'];
        }

        // tagAttributes
        if (array_key_exists('tagAttributes', $conf) && is_array($conf['tagAttributes'])){
            $this->tagAttributes = $conf['tagAttributes'];
        }

        // fields
        if (array_key_exists('fields', $conf) && is_array($conf['fields'])){
            $this->fields = $conf['fields'];
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