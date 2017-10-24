<?php
namespace FormLib;

class Submit extends FormField {

    /* Die Funktionen überschreiben die Funktionen aus der ElternKlasse */
    public function render () : string {
        $out = $this->renderField();
        return $out;
    }

    public function renderLabel () : string {
        return '';
    }

    public function renderError() : string {
        return '';
    }

    public function renderField () : string {
        
        // Input Tag
        $out = '';
        $out.= '<input type="submit" ' .
            'id="' .
            $this->id .
            '" ' .
            'value="' .
            $this->value .
            '"';
        $out .= $this->renderTagAttributes(); 
        $out .= '>';
        return $out;
    }

    public function setValue($value) {
        return;
    }
}