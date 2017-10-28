<?php
namespace FormLib;

class Radio extends FormField {
    private $values = [];
    // Optionale CSS-Klasse für umschließendes fieldset.
    private $fieldsetClass = '';

    public function __construct ($conf) {
        parent::__construct($conf);

        if (array_key_exists('values', $conf) &&
            is_array($conf['values']) &&
            count($conf['values']) > 0) {
            $this->values = $conf['values'];
        }

        if (array_key_exists('fieldsetClass', $conf)) {
            $this->fieldsetClass = $conf['fieldsetClass'];
        }
    }

    /**
     * Die Radio Buttons werden mit fieldset umschlossen erstellt.
     * @return string
     */
    public function renderField() : string {
        $fsClass = '';
        if ($this->fieldsetClass !== '') {
            $fsClass = ' class="' .  $this->fieldsetClass . '"';
        }
        $out = '<fieldset' . $fsClass  .'><caption>' . $this->label . '</caption>';
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

                    $out .= '> ' .
                    $text . '</label>';
        }
        $out .= '</fieldset>';

        return $out;
    }
}