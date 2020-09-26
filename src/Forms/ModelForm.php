<?php

namespace SierraTecnologia\FormMaker\Forms;

use Exception;
use Illuminate\Routing\UrlGenerator;
use SierraTecnologia\FormMaker\Forms\HtmlForm;
use SierraTecnologia\FormMaker\Services\FormMaker;
use SierraTecnologia\FormMaker\Builders\FieldBuilder;

class ModelForm extends HtmlForm
{
    /**
     * Model class
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model;

    /**
     * Model instance
     *
     * @var \Illuminate\Database\Eloquent\Model|null
     */
    public $instance = null;

    /**
     * The database connection
     *
     * @var string
     */
    public $connection;

    /**
     * The route prefix, generally single form of model
     *
     * @var string
     */
    public $routePrefix;

    /**
     * Form routes
     *
     * @var array
     */
    public $routes = [
        'create' => '.store',
        'update' => '.update',
        'delete' => '.destroy',
    ];

    /**
     * Form methods
     *
     * @var array
     */
    public $methods = [
        'create' => 'post',
        'update' => 'put',
        'delete' => 'delete',
    ];

    /**
     * The field builder
     *
     * @var \SierraTecnologia\FormMaker\Builders\FieldBuilder
     */
    protected $builder;

    /**
     * A create form for a model
     *
     * @return self
     */
    public function create(): self
    {
        $this->builder->setSections($this->setSections());

        if ($this->orientation == 'horizontal') {
            if ($this->formClass === config('form-maker.form.horizontal-class')) {
                $this->formClass = config('form-maker.form.horizontal-class', 'form-horizontal');
            }
        }

        $this->html = $this->open(
            [
            'route' => [
                $this->routes['create']
            ],
            'files' => $this->hasFiles,
            'class' => $this->formClass
            ]
        );

        $fields = $this->parseFields($this->fields());

        $this->renderedFields = $this->builder
            ->setConnection($this->connection)
            ->setColumns($this->columns)
            ->fromTable($this->modelClass->getTable(), $fields);

        $this->html .= $this->renderedFields;

        $this->html .= $this->formButtonsAndClose();

        return $this;
    }

    public function setInstance($model): self
    {
        $this->instance = $model;

        return $this;
    }

    public function factoryFields(): string
    {
        $factory = '';

        foreach ($this->fields() as $settings) {
            $field = array_keys($settings)[0];
            if (!is_null($settings[$field]['factory'])) {
                $factory .= "\x20\x20\x20\x20\x20\x20\x20\x20'{$field}' => \$faker->{$settings[$field]['factory']},\n";
            }
        }

        return $factory;
    }
}
