<?php

class CheckBox extends FormField {
    private $checked ='';

    public function __construct (array $conf) {
        parent::__construct($conf);

        if (array_key_exists('checked',$conf) && $conf['checked'] === 'true') {
            $this->checked=' checked';
        }
        if (array_key_exists('value',$conf) && $conf['value'] !== '') {
            $this->value=$conf['value'];
        }
    }
    /* Die Funktionen überschreiben die Funktionen aus der ElternKlasse */
    public function render () {
        $out = '';
        //Label erstellen
        $out .= $this->renderLabel();
        // Checkbox erstellen
/*         $out .= $this->renderField(); */
        // Error Massage
        $out .= $this->renderError();
        return $out;
    }

    public function renderLabel () {
        $out = '';
        //Label erstellen
        $out.= '<label for="' . 
            $this->id .
            '">' . 
            $this->renderField() .            
            ' ' . 
            $this->label .
            '</label>';
        return $out;
    }
    public function renderField () {
        
        // Input Tag
        $out = '';
        $out.= '<input type="' . 
            $this->type .
            '" ' .
            'id="' .
            $this->id .
            '" ' .
            'name="' .
            $this->name .
            '" ' .
            'value="' .
            $this->value .
            '"' .
            $this->checked .
            '>';
        return $out;
    }
}