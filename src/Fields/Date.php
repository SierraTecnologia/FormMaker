<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Date extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'date';
    }

    /**
     * @return string[]
     *
     * @psalm-return array{format: string, before: string}
     */
    protected static function getOptions()
    {
        return [
            'format' => 'Y-m-d',
            'before' => 'Date',
        ];
    }

    /**
     * @return string
     */
    protected static function getFactory()
    {
        return 'date';
    }
}
