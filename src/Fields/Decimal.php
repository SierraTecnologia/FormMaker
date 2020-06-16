<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Decimal extends Field
{
    protected static function getType()
    {
        return 'number';
    }

    protected static function getAttributes()
    {
        return [
            'step' => 'any',
        ];
    }

    protected static function getFactory()
    {
        return 'randomFloat';
    }
}
