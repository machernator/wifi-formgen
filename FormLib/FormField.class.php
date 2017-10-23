<?php
namespace FormLib;

class FormField {
    protected $id = '';
    protected $name = '';
    protected $label = '';
    protected $type = '';
    protected $dataType = '';
    protected $minLen = 0;
    protected $maxLen = 0;
    protected $error = '';
    protected $value = '';
    protected $tagAttributes = [];

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

        // type
        if (array_key_exists('type', $conf) && $conf['type'] !== '') {
            $this->type = $conf['type'];
        }
        else {
            die("Konfigurationsfehler: type");
        }
        
        // dataType
        if (array_key_exists('dataType', $conf) && $conf['dataType'] !== '') {
            $this->dataType = $conf['dataType'];
        }
        else {
            die("Konfigurationsfehler: dataType");
        }

        // value
        if (array_key_exists('value', $conf) && $conf['value'] !== ''){
            $this->value = $conf['value'];
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

    public function render() : string {
        $out = '';
        // Label
        $out .= $this->renderLabel();
        // Input Tag
        $out .= $this->renderField();        
        // Error Message
        $out .= $this->renderError();        
        
        return $out;
    }

    public function renderLabel() : string {
        $out = '';
        $out .= '<label for="' . 
            $this->id . 
            '">' .
            $this->label .
            '</label>';
        return $out;
    }

    public function renderField() : string {
        $out = '';
        $out .= '<input type="' .
            $this->type . 
            '" ' . 
            'name="' . 
            $this->name .
            '"';
        // TODO: value 
        
        // tagAttributes
        $out .= $this->renderTagAttributes(); 
        $out .= '>';
        return $out;
    }

    public function renderError() : string {
        // TODO: Eltern Element bestimmen
        return $this->error;
    }

    protected function renderTagAttributes() : string {
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