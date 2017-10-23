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
     * Undocumented function
     *
     * @param array $conf
     */
    public function __construct(array $conf) {

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