<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class CustomFile extends Field
{
    protected static function getType()
    {
        return 'custom-file';
    }

    protected static function getOptions()
    {
        return [
            'before' => 'Upload',
        ];
    }

    protected static function getFactory()
    {
        return 'image';
    }
}
