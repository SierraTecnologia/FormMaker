<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class CustomFile extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'custom-file';
    }

    /**
     * @return string[]
     *
     * @psalm-return array{before: string}
     */
    protected static function getOptions()
    {
        return [
            'before' => 'Upload',
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
