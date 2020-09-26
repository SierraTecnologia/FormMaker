<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Image extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'image';
    }

    /**
     * @return string[]
     *
     * @psalm-return array{before: string}
     */
    protected static function getOptions()
    {
        return [
            'before' => 'Image',
        ];
    }

    /**
     * @return string
     */
    protected static function getFactory()
    {
        return 'image';
    }
}
