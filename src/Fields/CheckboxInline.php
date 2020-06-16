<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class CheckboxInline extends Field
{
    protected static function getType()
    {
        return 'checkbox-inline';
    }

    protected static function getAttributes()
    {
        return [
            'class' => 'form-check-input',
        ];
    }

    protected static function getFactory()
    {
        return 'boolean';
    }
}
