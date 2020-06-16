<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class HasOne extends Field
{
    protected static function getType()
    {
        return 'relationship';
    }

    protected static function getFactory()
    {
        return null;
    }
}
