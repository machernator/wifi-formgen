<?php
class Select extends FormField {
    private $values = [];

    public function __construct ($conf) {
        parent::__construct($conf);

        if (array_key_exists('values', $conf) && 
            is_array($conf['values']) && 
            count($conf['values']) > 0) {
            $this->values = $conf['values'];
        }
    }

    public function render() : string {
        $out = '';
        $out .= $this->renderLabel();
        $out .= $this->renderField(); 
        $out .= $this->renderError();

        return $out;
    }

    public function renderField() : string {
        $out = '';
        $out .= '<select name="' .
                $this->name .
                '"' .
                ' id="' .
                $this->id .
                '"' .
                $this->renderTagAttributes() .
                '>';
        foreach ($this->values as $value => $text) {
            $out .= '<option ' .
            ' value="' .
            $value . '"';
            // Vorausgewählt, wenn aktueller Wert dem in der
            // Konfiguration entspricht
            
            if ($value === $this->value || (is_array($this->value) && in_array($value, $this->value))) {
                $out .= ' selected';
            }

            $out .= '>' .
            $text .
            '</option>';
        }
        $out .= '</select>';
        return $out;
    }
}