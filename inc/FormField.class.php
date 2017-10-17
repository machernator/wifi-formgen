<?php
class FormField {
    private $id = '';
    private $name = '';
    private $label = '';
    private $dataType = '';
    private $minLen = 0;
    private $maxLen = 0;
    private $tagAttributes = [];

    public function __construct(array $conf) {
        //// Pflichtfelder
        // id
        if (array_key_exists('id', $conf) && $conf['id'] !== '') {
            $this->id = $conf['id'];
        }
        else {
            die("Konfigurationsfehler: id");
        }
        
        // name
        if (array_key_exists('name', $conf) && $conf['name'] !== '') {
            $this->name = $conf['name'];
        }
        else {
            die("Konfigurationsfehler: name");
        }

         // label
         if (array_key_exists('label', $conf) && $conf['label'] !== '') {
            $this->label = $conf['label'];
        }
        else {
            die("Konfigurationsfehler: label");
        }
        
        // dataType
        if (array_key_exists('dataType', $conf) && $conf['dataType'] !== '') {
            $this->dataType = $conf['dataType'];
        }
        else {
            die("Konfigurationsfehler: dataType");
        }

        // minlen
        if (array_key_exists('minLen', $conf) && $conf['minLen'] !== ''){
            $this->minLen = $conf['minLen'];
        }

        // maxLen
        if (array_key_exists('maxLen', $conf) && $conf['maxLen'] !== ''){
            $this->maxLen = $conf['maxLen'];
        }

        // tagAttributes
        if (array_key_exists('tagAttributes', $conf) && is_array($conf['tagAttributes'])){
            $this->tagAttributes = $conf['tagAttributes'];
        }
    }
}