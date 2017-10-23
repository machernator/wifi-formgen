<?php
namespace FormLib;

class Textarea extends FormField {
    /**
     * Textarea wird ausgegeben
     *
     * @return string
     */
    public function renderField() : string {
        $out = '';
        $out .= '<textarea name="' . 
            $this->name .
            '"';
        // tagAttributes
        $out .= $this->renderTagAttributes(); 
        $out .= '>';
        // TODO: value

        $out .= '</textarea>';
        return $out;
    }
}