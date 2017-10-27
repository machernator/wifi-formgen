<?php
namespace FormLib;

class FormField {
    protected $id = '';
    protected $name = '';
    protected $label = '';
    protected $type = '';
    protected $dataType = '';

    protected $error = '';
    protected $errorClass = '';
    protected $value = '';
    protected $tagAttributes = [];

    protected $validationRules = '';
    protected $filters = '';

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

        // error
        if (array_key_exists('error', $conf)){
            $this->error = $conf['error'];
        }

        // validationRules
        if (array_key_exists('validationRules', $conf) && $conf['validationRules'] !== '') {
            $this->validationRules = $conf['validationRules'];
        }

        // filters
        if (array_key_exists('filters', $conf) && $conf['filters'] !== '') {
            $this->filters = $conf['filters'];
        }
    }

    public function getValidationRules() : string {
        return $this->validationRules;
    }

    public function getFilters() : string {
        return $this->filters;
    }

    /**
     * Ausgabe des Input Feldes in HTML
     *
     * @return string
     */
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

    /**
     * Ausgabe des label Tags
     *
     * @return string
     */
    public function renderLabel() : string {
        $out = '';
        $out .= '<label for="' .
            $this->id .
            '">' .
            $this->label .
            '</label>';
        return $out;
    }

    /**
     * Ausgabe des Input Tags
     *
     * @return string
     */
    public function renderField() : string {
        $out = '';
        $out .= '<input type="' .
            $this->type .
            '" ' .
            'name="' .
            $this->name .
            '" ' .
            'id="' .
            $this->id .
            '"';

            if ($this->value !== '') {
                $out .= ' value="' . $this->value . '"';
            }


        // tagAttributes
        $out .= $this->renderTagAttributes();
        $out .= '>';
        return $out;
    }

    /**
     * Fehlermeldung auch nach dem Konstruktor setzen können
     *
     * @param string $error
     * @return void
     */
    public function setError(string $error) {
        $this->error = $error;
    }

    /**
     * [setValue description]
     * @param [type] $value [description]
     */
    public function setValue($value) {
        $this->value = $value;
    }

    /**
     * Fehlermeldung für unser Feld zurückgeben
     *
     * @return string
     */
    public function renderError() : string {
        $errorClass = '';

        if ($this->errorClass !== '') {
            $errorClass = ' class="' . $this->errorClass . '"';
        }

        if ($this->error !== ''){

            return '<div' . $errorClass . '>' . $this->error . '</div>';
        }

        return '';
    }

    /**
     * Erzeugt String mit beliebigen weiteren Attributen des Input Tags.
     *
     * @return string
     */
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