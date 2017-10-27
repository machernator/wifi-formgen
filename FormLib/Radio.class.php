<?php
namespace FormLib;

class Radio extends FormField {
    private $values = [];

    public function __construct ($conf) {
        parent::__construct($conf);

        if (array_key_exists('values', $conf) &&
            is_array($conf['values']) &&
            count($conf['values']) > 0) {
            $this->values = $conf['values'];
        }
    }

    /**
     * Die Radio Buttons werden mit Label umschlossen erstellt.
     * @return string
     */
    public function renderField() : string {
        $out = '';
        foreach ($this->values as $value => $text) {
            $out .= '<label>';
            $out .= '<input type="radio" name="' .
                    $this->name .
                    '" ' .
                    // TODO: wie soll ID erstellt werden?
                    // 'id="' . $this->name . '_' . $value . '"' .
                    ' value="' .
                    $value . '"';
                    // Vorausgewählt, wenn aktueller Wert dem in der
                    // Konfiguration entspricht
                    if ($value === $this->value) {
                        $out .= ' checked';
                    }

                    $out .= '>' .
                    $text . '</label>';
        }

        return $out;
    }
}