<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Range extends Field
{
    protected static function getType()
    {
        return 'range';
    }

    protected static function getFactory()
    {
        return 'numberBetween(1, 10)';
    }
}
