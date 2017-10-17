<?php
class Textarea extends FormField {
    public function renderField() {
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