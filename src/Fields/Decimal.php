<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Decimal extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'number';
    }

    /**
     * @return string[]
     *
     * @psalm-return array{step: string}
     */
    protected static function getAttributes()
    {
        return [
            'step' => 'any',
        ];
    }

    /**
     * @return string
     */
    protected static function getFactory()
    {
        return 'randomFloat';
    }
}
