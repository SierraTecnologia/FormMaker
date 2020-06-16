<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Checkbox extends Field
{
    protected static function getType()
    {
        return 'checkbox';
    }

    protected static function getAttributes()
    {
        return [
            'class' => 'form-check-input'
        ];
    }

    protected static function getFactory()
    {
        return 'boolean';
    }
}
