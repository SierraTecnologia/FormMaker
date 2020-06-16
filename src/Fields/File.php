<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class File extends Field
{
    protected static function getType()
    {
        return 'file';
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
