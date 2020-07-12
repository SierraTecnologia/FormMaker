<?php

namespace SierraTecnologia\FormMaker\Builders;

use DateTime;
use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;

class FieldBuilder
{
    /**
     * Create a submit button element.
     *
     * @param  string $value
     * @param  array  $options
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function submit($value = null, $options = [])
    {
        return $this->makeInput('submit', null, $value, $options);
    }

    /**
     * Make an html button
     *
     * @param string $value
     * @param array $options
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function button($value = null, $options = [])
    {
        if (! array_key_exists('type', $options)) {
            $options['type'] = 'button';
        }

        return '<button' . $this->attributes($options) . '>' . $value . '</button>';
    }

    /**
     * Make an input string
     *
     * @param string $type
     * @param string $name
     * @param mixed $value
     * @param array $options
     *
     * @return string
     */
    public function makeInput($type, $name, $value, $options = [])
    {
        if ($value instanceof DateTime) {
            $value = $value->format($options['format'] ?? 'Y-m-d');
        }

        if (isset($options['value']) && is_null($value)) {
            $value = $options['value'];
            unset($options['value']);
        }

        return '<input ' . $this->attributes($options) . ' name="' . $name . '" type="' . $type . '" value="' . e($value) . '">';
    }

    /**
     * Make an field string
     *
     * @param string $type
     * @param string $name
     * @param mixed $value
     * @param array $options
     *
     * @return string
     */
    public function makeField($type, $name, $value, $options = [])
    {
        if ($value instanceof DateTime) {
            $value = $value->format($options['format'] ?? 'Y-m-d');
        }

        return '<' . $type . ' ' . $this->attributes($options) . ' name="' . $name . '" value="' . e($value) . '"></' . $type . '>';
    }

    /**
     * Build an HTML attribute string from an array.
     *
     * @param array $attributes
     *
     * @return string
     */
    public function attributes($attributes)
    {
        $html = [];

        foreach ((array) $attributes as $key => $value) {
            $element = $this->attributeElement($key, $value);

            if (! is_null($element)) {
                $html[] = $element;
            }
        }

        return count($html) > 0 ? ' ' . implode(' ', $html) : '';
    }

    /**
     * Build a single attribute element.
     *
     * @param string $key
     * @param string $value
     *
     * @return string
     */
    public function attributeElement($key, $value)
    {
        if (is_numeric($key)) {
            return $value;
        }

        if (is_bool($value) && $key !== 'value') {
            return $value ? $key : '';
        }

        if (is_array($value) && $key === 'class') {
            return 'class="' . implode(' ', $value) . '"';
        }

        if (! is_null($value)) {
            return $key . '="' . e($value, false) . '"';
        }
    }

    /**
     * Make text input.
     *
     * @param array  $config
     * @param string $population
     * @param mixed $custom
     *
     * @return string
     */
    public function makeCustomFile($name, $value, $options)
    {
        if (isset($options['multiple'])) {
            $name = $name . '[]';
        }

        unset($options['class']);

        $fileLabel = config('form-maker.forms.custom-file-label', 'custom-file-label');
        $customFileClass = config('form-maker.forms.custom-file-input-class', 'custom-file-input');
        $customFileWrapperClass = config('form-maker.forms.custom-file-wrapper-class', 'custom-file');

        $label = '<label class="' . $fileLabel . '" for="' . $options['attributes']['id'] . '">Choose file</label>';
        $attributes = $this->attributes($options['attributes']);

        $input = '<div class="' . $customFileWrapperClass . '">';
        $input .= '<input ' . $attributes . ' class="' . $customFileClass . '" type="file" name="' . $name . '">';
        $input .= $label . '</div>';

        return $input;
    }

    /**
     * Make a textarea.
     *
     * @param string  $name
     * @param mixed $value
     * @param array $options
     *
     * @return string
     */
    public function makeTextarea($name, $value, $options)
    {
        $attributes = $this->attributes($options['attributes']);

        return '<textarea ' . $attributes . ' name="' . $name . '">' . e($value) . '</textarea>';
    }

    /**
     * Make a inline checkbox.
     *
     * @param string  $name
     * @param mixed $value
     * @param array $options
     *
     * @return string
     */
    public function makeCheckboxInline($name, $value, $options)
    {
        $options['check-inline'] = true;

        return $this->makeCheckbox($name, $value, $options);
    }

    /**
     * Make a inline radio.
     *
     * @param string $name
     * @param mixed $value
     * @param array $options
     *
     * @return string
     */
    public function makeRadioInline($name, $value, $options)
    {
        $options['check-inline'] = true;

        return $this->makeRadio($name, $value, $options);
    }

    /**
     * Make a select.
     *
     * @param string $name
     * @param mixed $selected
     * @param array $options
     *
     * @return string
     */
    public function makeSelect($name, $selected, $options)
    {
        $selectOptions = '';
        unset($options['attributes']['value']);

        if (isset($options['value']) && is_null($selected)) {
            $selected = $options['value'];
        }

        if (isset($options['value']) && !is_null($selected)) {
            $selected = $options['value'];
        }

        if (isset($options['attributes']['multiple'])) {
            $name = $name . '[]';
        }

        if (isset($options['null_value']) && $options['null_value']) {
            $nullValue = [];
            $nullValue[$options['null_label'] ?? 'None'] = null;
            $options['options'] = array_merge($nullValue, $options['options']);
        }

        foreach ($options['options'] as $key => $value) {
            $selectedValue = '';

            if (
                isset($options['attributes']['multiple'])
                && (is_object($selected) || is_array($selected))
            ) {
                if (in_array($value, collect($selected)->toArray())) {
                    $selectedValue = 'selected';
                }
            }

            if ($selected === $value) {
                $selectedValue = 'selected';
            }

            $selectOptions .= '<option value="' . $value . '" ' . $selectedValue . '>' . $key . '</option>';
        }

        $attributes = $this->attributes($options['attributes']);

        return '<select ' . $attributes . ' name="' . $name . '">' . $selectOptions . '</select>';
    }

    /**
     * Make a checkbox.
     *
     * @param string $name
     * @param mixed $value
     * @param array $options
     *
     * @return string
     */
    public function makeCheckInput($name, $value, $options)
    {
        $options['attributes']['class'] = config('form-maker.form.check-input-class', 'form-check-input');

        if (Str::contains($options['type'], '-inline')) {
            $options['check-inline'] = true;
        }

        if (in_array($options['type'], ['radio', 'radio-inline'])) {
            $field = $this->makeRadio($name, $value, $options);
        }

        $field = $this->makeCheckbox($name, $value, $options);

        $formClass = config('form-maker.form.check-class', 'form-check');

        if (isset($options['check-inline'])) {
            $formClass = config('form-maker.form.check-inline-class', 'form-check form-check-inline');
        }

        $fieldWrapper = "<div class=\"{$formClass}\">";

        $label = str_replace('_', ' ', $this->getLabel($name, $options));

        if (Str::contains($label, '[')) {
            $label = $this->getNestedFieldLabel($label)[0];
        }

        $labelClass = config('form-maker.form.label-check-class', 'form-check-label');

        $fieldLabel = "<label class=\"{$labelClass}\">{$label}</label>";

        return $fieldWrapper . $field . $fieldLabel . '</div>';
    }


    /**
     * Make a checkbox.
     *
     * @param string $name
     * @param mixed $value
     * @param array $options
     *
     * @return string
     */
    public function makeCheckbox($name, $value, $options)
    {
        $checked = $this->isChecked($name, $value, $options);
        $attributes = $this->attributes($options['attributes']);

        return '<input ' . $attributes . ' type="checkbox" name="' . $name . '" ' . $checked . '>';
    }

    /**
     * Make a radio.
     *
     * @param string $name
     * @param mixed $value
     * @param array $options
     *
     * @return string
     */
    public function makeRadio($name, $value, $options)
    {
        $checked = $this->isChecked($name, $value, $options);
        $attributes = $this->attributes($options['attributes']);

        return '<input ' . $attributes . ' type="radio" name="' . $name . '" ' . $checked . '>';
    }

    /**
     * Make a relationship input.
     *
     * @param string $name
     * @param mixed $value
     * @param array $options
     *
     * @return string
     */
    public function makeRelationship($name, $value, $options)
    {
        $method = 'all';
        $class = $options['model'];

        if (!is_object($class)) {
            $class = app()->make($options['model']);
        }

        if (isset($options['model_options']['method'])) {
            $method = $options['model_options']['method'];
        }

        if (!isset($options['model_options']['params'])) {
            $items = $class->$method();
        }

        if (isset($options['model_options']['params'])) {
            $items = $class->$method($options['model_options']['params']);
        }

        if (isset($options['null_value']) && $options['null_value']) {
            $options['options'][$options['null_label']] = null;
        }

        foreach ($items as $item) {
            $optionLabel = $options['model_options']['label'] ?? 'name';
            $optionValue = $options['model_options']['value'] ?? 'id';

            $options['options'][$item->$optionLabel] = $item->$optionValue;
        }

        // In case we get an Eloquent Collection or Collection
        // without specifying the ID tag which we're checking
        // the select values from - we need to set the values
        // to an array of IDs.
        if (method_exists($value, 'toArray')) {
            $parsedValues = [];
            $optionValue = $options['model_options']['value'];

            foreach ($value->toArray() as $valueItem) {
                $parsedValues[] = $valueItem[$optionValue];
            }

            $value = $parsedValues;
        }

        return $this->makeSelect($name, $value, $options);
    }

    /**
     * Check if a field is checked
     *
     * @param mixed $value
     * @param array $options
     *
     * @return boolean
     */
    public function isChecked($name, $value, $options)
    {
        if (isset($options['attributes']['value'])) {
            if ($value === $options['attributes']['value']) {
                return 'checked';
            }
        }

        if (is_bool($value) && !$value) {
            return '';
        }

        if (Str::contains($name, $value)) {
            return 'checked';
        }

        if ($value === true || $value === 'on' || $value === 1) {
            return 'checked';
        }

        return '';
    }

    private function getNestedFieldLabel($label)
    {
        preg_match_all("/\[([^\]]*)\]/", $label, $matches);

        return $matches[1];
    }

    /**
     * Transform the string to an Html serializable object
     *
     * @param $html
     *
     * @return \Illuminate\Support\HtmlString
     */
    protected function toHtmlString($html)
    {
        return new HtmlString($html);
    }
    
    protected function getLabel($name, $options)
    {
        if (!isset($options['label']) || $label === '') {
            return Str::title($name);
        }
        return $options['label'];
    }
}
