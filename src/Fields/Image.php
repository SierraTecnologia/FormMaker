<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Image extends Field
{
    protected static function getType()
    {
        return 'image';
    }

    protected static function getOptions()
    {
        return [
            'before' => 'Image',
        ];
    }

    protected static function getFactory()
    {
        return 'image';
    }
}
