<?php
namespace FormLib;

class CheckBox extends FormField {
    private $checked = '';

    public function __construct (array $conf) {
        parent::__construct($conf);

        if (array_key_exists('checked',$conf) && $conf['checked'] === true) {
            $this->checked=' checked';
        }
    }
    
    /**
     * Überschriebene render Methode
     *
     * @return string
     */
    public function render () : string{
        $out = '';
        $out .= $this->renderField();
        $out .= $this->renderError();
        return $out;
    }

    /**
     * Überschriebene renderField Methode. Label Tag wird um input geschrieben.
     *
     * @return string
     */
    public function renderField () : string {
        // Input Tag
        $out = '<label for="' . 
        $this->id .
        '">' . 
        '<input type="' . 
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
            '> ' . 
            $this->label .
            '</label>';
        return $out;
    }
}