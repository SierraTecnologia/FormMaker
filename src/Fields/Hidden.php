<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Hidden extends Field
{
    protected static function getType()
    {
        return 'hidden';
    }

    protected static function getFactory()
    {
        return 'text(50)';
    }
}
