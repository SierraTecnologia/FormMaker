<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Checkbox extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'checkbox';
    }

    /**
     * @return string[]
     *
     * @psalm-return array{class: string}
     */
    protected static function getAttributes()
    {
        return [
            'class' => 'form-check-input'
        ];
    }

    /**
     * @return string
     */
    protected static function getFactory()
    {
        return 'boolean';
    }
}
