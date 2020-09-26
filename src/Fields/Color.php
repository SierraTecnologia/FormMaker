<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Color extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'color';
    }

    /**
     * @return string[]
     *
     * @psalm-return array{before: string}
     */
    protected static function getOptions()
    {
        return [
            'before' => 'Color',
        ];
    }

    /**
     * @return string
     */
    protected static function getFactory()
    {
        return 'safeColorName';
    }
}
