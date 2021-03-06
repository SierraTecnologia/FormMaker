<?php

namespace SierraTecnologia\FormMaker\Services;

use Exception;
use Illuminate\Support\Str;
use SierraTecnologia\FormMaker\Builders\FieldBuilder;

class FieldMaker
{
    protected $builder;

    public $orientation;

    protected $standard = [
        'hidden',
        'text',
        'number',
        'color',
        'email',
        'date',
        'datetime-local',
        'month',
        'range',
        'search',
        'tel',
        'time',
        'url',
        'week',
        'password',
        'time',
        'image',
        'file',
    ];

    protected $special = [
        'select',
        'custom-file',
        'textarea',
        'relationship',
    ];

    protected $specialSelect = [
        'checkbox',
        'radio',
        'checkbox-inline',
        'radio-inline',
    ];

    public function __construct(FieldBuilder $fieldBuilder)
    {
        $this->builder = $fieldBuilder;
    }

    private function convertType(string $type): string 
    {
        $configs = config('form-maker.inputTypes', [
            'number'            => 'number',
            'integer'           => 'number',
            'float'             => 'number',
            'decimal'           => 'number',
            'boolean'           => 'number',
            'string'            => 'text',
            'email'             => 'text',
            'varchar'           => 'text',
            'file'              => 'file',
            'image'             => 'file',
            'datetime'          => 'date',
            'date'              => 'date',
            'password'          => 'password',
            'textarea'          => 'textarea',
            'select'            => null,
            'checkbox'          => null,
            'checkbox-inline'   => null,
            'radio'             => null,
            'radio-inline'      => null,
        ]);

        if (isset($configs[$type]) && !is_null($configs[$type])) {
            return $configs[$type];
        }
        return $type;
    }

    public function make(string $column, array $columnConfig, $object = null)
    {
        if (!isset($columnConfig['type'])) {
            \Log::info('Tipo de Campo sem valor Type', [
                $column,  $columnConfig, $object
            ]);
        }
        if (isset($columnConfig['type']) && $columnConfig['type'] === 'html') {
            return $columnConfig['content'];
        }

        $field = null;
        $fieldGroup = config('form-maker.form.group-class', 'form-group');

        if ($this->orientation === 'horizontal') {
            $fieldGroup = $fieldGroup . ' ' . config('form-maker.form.sections.row-class', 'row');
        }

        $value = $this->getOldValue($column);

        if (!is_null($object)) {
            $value = $this->getObjectValue($object, $column);
        }

        $errors = $this->getFieldErrors($column, $object);

        $label = $this->label($column, $columnConfig, null, $errors);

        if (isset($columnConfig['type']) && (
            in_array($columnConfig['type'], $this->standard) || in_array($this->convertType($columnConfig['type']), $this->standard)
        )) {
            $field = $this->builder->makeInput(
                $columnConfig['type'],
                $column,
                $value,
                $this->parseOptions($column, $columnConfig)['attributes']
            );
        }

        if (isset($columnConfig['type']) && (in_array($columnConfig['type'], $this->special) || in_array($this->convertType($columnConfig['type']), $this->special))) {
            $method = 'make' . ucfirst(Str::camel($columnConfig['type']));
            $field = $this->builder->$method(
                $column,
                $value,
                $this->parseOptions($column, $columnConfig)
            );
        }

        if (isset($columnConfig['template'])) {
            $rowClass = config('form-maker.form.group-class', 'form-group');
            $labelClass = config('form-maker.form.label-class', 'control-label');
            $fieldClass = '';

            if ($this->orientation === 'horizontal') {
                $labelClass = config('form-maker.form.label-column', 'col-md-2 col-form-label pt-0');
                $fieldClass = config('form-maker.form.input-column', 'col-md-10');
                $rowClass = $rowClass . ' ' . config('form-maker.form.sections.row-class', 'row');
            }

            $options = $this->parseOptions($column, $columnConfig);
            $id = $options['attributes']['id'];

            $name = Str::title($column);
            $name = str_replace('_', ' ', $name);
            $name = $options['label'] ?? $name;

            return $this->fieldTemplate(
                $columnConfig['template'], compact(
                    'rowClass',
                    'labelClass',
                    'fieldClass',
                    'label',
                    'field',
                    'errors',
                    'id',
                    'name'
                )
            );
        }

        if (isset($columnConfig['view'])) {
            $options = $this->parseOptions($column, $columnConfig);

            return view(
                $columnConfig['view'], compact(
                    'label',
                    'field',
                    'errors',
                    'options'
                )
            )->render();
        }

        if (isset($columnConfig['type']) && in_array($columnConfig['type'], $this->specialSelect)) {
            $label = '';

            $field = $this->builder->makeCheckInput(
                $column,
                $value,
                $this->parseOptions($column, $columnConfig)
            );
        }

        if (is_null($field) && isset($columnConfig['type'])) {
            $field = $this->builder->makeInput( // @todo Alterei pq o html5 string nao existe makeField(
                $columnConfig['type'],
                $column,
                $value,
                $this->parseOptions($column, $columnConfig)['attributes']
            );
        }

        $before = $this->before($columnConfig);
        $after = $this->after($columnConfig);

        $fieldString = $before . $field . $after;

        if ($this->orientation === 'horizontal') {
            $labelColumn = config('form-maker.form.label-column', 'col-md-2 col-form-label pt-0');
            $inputColumn = config('form-maker.form.input-column', 'col-md-10');

            $label = $this->label($column, $columnConfig, $labelColumn, $errors);

            if (isset($columnConfig['type']) && in_array($columnConfig['type'], $this->specialSelect)) {
                $legend = $columnConfig['legend'] ?? $columnConfig['label'];
                $label = "<legend class=\"{$labelColumn}\">{$legend}</legend>";
            }

            $fieldString = "<div class=\"{$inputColumn}\">{$fieldString}</div>";
        }

        return $this->wrapField($fieldGroup, $label, $fieldString, $errors);
    }

    public function label(string $column, array $columnConfig, $class = null, $errors)
    {
        $label = Str::title($column);
        $label = str_replace('_', ' ', $label);

        if (Str::contains($label, '[')) {
            $label = $this->getNestedFieldLabel($label)[0];
        }

        if (is_null($class)) {
            $class = config('form-maker.form.label-class', 'control-label');
        }

        if (isset($columnConfig['label'])) {
            $label = $columnConfig['label'];
        }

        if (!empty($errors)) {
            $class = $class . ' ' . config('form-maker.form.error-class', 'has-error');
        }

        $id = $columnConfig['attributes']['id'] ?? $this->stripArrayHandles($column);

        return "<label class=\"{$class}\" for=\"{$id}\">{$label}</label>";
    }

    public function wrapField($fieldGroup, $label, string $fieldString, $errors)
    {
        if (Str::contains($fieldString, 'hidden')) {
            return $fieldString;
        }

        return "<div class=\"{$fieldGroup}\">{$label}{$fieldString}</div>{$errors}";
    }

    public function getObjectValue($object, string $name)
    {
        if (is_object($object) && isset($object->$name)) {
            return $object->$name;
        }

        // If its a nested value like meta[user[phone]]
        if (strpos($name, '[') > 0) {
            $nested = explode('[', str_replace(']', '', $name));
            $final = $object;

            foreach ($nested as $property) {
                if (!empty($property) && isset($final->{$property})) {
                    $final = $final->{$property};
                } elseif (is_object($final) && is_null($final->{$property})) {
                    $final = '';
                }
            }

            return $final;
        }

        return '';
    }

    public function getFieldErrors(string $column)
    {
        $textError = config('form-maker.form.text-error', 'text-danger');

        $errors = [];

        if (session()->isStarted()) {
            $errors = session('errors');
        }

        if (!is_null($errors) && count($errors) > 0) {
            $message = implode(' ', $errors->get($column));
            return "<div><p class=\"{$textError}\">{$message}</p></div>";
        }

        return '';
    }

    public function before(array $columnConfig)
    {
        $prefix = '';

        if (isset($columnConfig['before'])) {
            $class = config('form-maker.form.before_after_input_wrapper', 'input-group');
            $prefix = '<div class="' . $class . '">' . $columnConfig['before'];
        }

        return $prefix;
    }

    public function after(array $columnConfig)
    {
        $postfix = '';

        if (isset($columnConfig['after'])) {
            $postfix = $columnConfig['after'] . '</div>';
        }

        return $postfix;
    }

    /**
     * @param array $options
     */
    private function fieldTemplate($template, array $options)
    {
        $keys = [];
        $values = [];
        $processedTemplate = '';

        foreach ($options as $key => $option) {
            $keys[] = "{{$key}}";
            $values[] = $option;
        }

        return str_replace($keys, $values, $template);
    }

    private function getOldValue(string $column)
    {
        if (session()->isStarted()) {
            return request()->old($column);
        }

        return null;
    }

    private function parseOptions(string $name, array $options)
    {
        $default = [
            'class' => config('form-maker.form.input-class', 'form-control'),
            'id' => ucfirst($name),
        ];

        $options['attributes'] = array_merge($default, $options['attributes'] ?? []);

        return $options;
    }

    private function stripArrayHandles($column)
    {
        return str_replace('[]', '', ucfirst($column));
    }

    private function getNestedFieldLabel(string $label)
    {
        preg_match_all("/\[([^\]]*)\]/", $label, $matches);

        return $matches[1];
    }
}
