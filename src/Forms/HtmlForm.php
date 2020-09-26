<?php

namespace SierraTecnologia\FormMaker\Forms;

use Exception;
use SierraTecnologia\FormMaker\Forms\Form;

class HtmlForm extends Form
{
    /**
     * The form orientation
     *
     * @var string
     */
    public $orientation;

    /**
     * The form class
     *
     * @var string
     */
    public $formClass;

    /**
     * The form delete class
     *
     * @var string
     */
    public $formDeleteClass;

    /**
     * Number of columns for the form
     *
     * @var integer
     */
    public $columns = 1;

    /**
     * Whether or not the form has files
     *
     * @var boolean
     */
    public $hasFiles = false;

    /**
     * An alternative method to perform the form submission
     *
     * @var string
     */
    public $submitMethod = null;

    /**
     * Html string for output
     *
     * @var string
     */
    protected $html;

    /**
     * Html string of rendered fields
     *
     * @var string
     */
    protected $renderedFields;

    /**
     * Message for delete confirmation
     *
     * @var string
     */
    public $confirmMessage;

    /**
     * Method for delete confirmation
     *
     * @var string
     */
    public $confirmMethod;

    /**
     * The field builder
     *
     * @var \SierraTecnologia\FormMaker\Builders\FieldBuilder
     */
    protected $builder;

    /**
     * Form button words
     *
     * @var array
     */
    public $buttons = [
        'submit' => 'Submit',
        'cancel' => 'Cancel',
    ];

    /**
     * Form button links
     *
     * @var array
     */
    public $buttonLinks = [
        'cancel' => null,
    ];

    /**
     * Form button classes
     *
     * @var array
     */
    public $buttonClasses = [
        'submit' => null,
        'delete' => null,
        'cancel' => null,
    ];

    public function __construct()
    {
        parent::__construct();

        $buttonClasses = [
            'submit' => $this->buttonClasses['submit'] ?? config('form-maker.buttons.submit', 'btn btn-primary'),
            'delete' => $this->buttonClasses['delete'] ?? config('form-maker.buttons.delete', 'btn btn-danger'),
            'cancel' => $this->buttonClasses['cancel'] ?? config('form-maker.buttons.cancel', 'btn btn-secondary'),
        ];

        $this->buttonClasses = $buttonClasses;

        $this->formClass = $this->formClass ?? config('form-maker.form.class', 'form');
        $this->formDeleteClass = $this->formDeleteClass ?? config('form-maker.form.delete-class', 'form-inline');
    }

    /**
     * Append to the html the close form with buttons
     *
     * @return string
     */
    protected function formButtonsAndClose(): string
    {
        $rowAlignment = config('form-maker.form.sections.row-alignment-end', 'd-flex justify-content-end');

        if (isset($this->buttons['cancel'])) {
            $rowAlignment = config('form-maker.form.sections.row-alignment-between', 'd-flex justify-content-between');
        }

        $formRow = config('form-maker.form.sections.row', 'row');
        $formFullSizeColumn = config('form-maker.form.sections.full-size-column', 'col-md-12');

        $lastRowInForm = '<div class="' . $formRow . '">
            <div class="' . $formFullSizeColumn . ' ' . $rowAlignment . '">';

        if (isset($this->buttons['cancel'])) {
            $lastRowInForm .= '<a class="' . $this->buttonClasses['cancel']
                . '" href="' . url($this->buttonLinks['cancel']) . '">' . $this->buttons['cancel'] . '</a>';
        }

        if (!is_null($this->submitMethod)) {
            $lastRowInForm .= $this->field->button(
                $this->buttons['submit'], [
                'class' => $this->buttonClasses['submit'],
                'onclick' => "{$this->submitMethod}(event)"
                ]
            );
        } else {
            if (isset($this->buttons['submit'])) {
                $lastRowInForm .= $this->field->button(
                    $this->buttons['submit'], [
                    'class' => $this->buttonClasses['submit'],
                    'type' => 'submit'
                    ]
                );
            }
        }

        $lastRowInForm .= '</div></div>' . $this->close();

        return $lastRowInForm;
    }

    /**
     * Set the form sections
     *
     * @return array-key[][]
     *
     * @psalm-return array{0: list<array-key>}
     */
    public function setSections(): array
    {
        return [array_keys($this->parseFields($this->fields()))];
    }

    /**
     * Set the confirmation message for delete forms
     *
     * @param string $message
     * @param string $method
     *
     * @return \SierraTecnologia\FormMaker\Forms\ModelForm
     */
    public function confirm($message, $method = null)
    {
        $this->confirmMessage = $message;
        $this->confirmMethod = $method;

        return $this;
    }

    /**
     * Set the fields
     *
     * @return array
     *
     * @psalm-return array<empty, empty>
     */
    public function fields(): array
    {
        return [];
    }

    /**
     * Parse the fields to get proper config
     *
     * @param array $formFields
     *
     * @return array
     */
    protected function parseFields($formFields): array
    {
        $fields = [];

        if (empty($formFields)) {
            throw new Exception("Invalid fields", 1);
        }

        foreach ($formFields as $config) {
            $key = array_key_first($config);
            $fields[$key] = $config[$key];
        }

        return $fields;
    }

    /**
     * Output html as string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->html;
    }
}
