<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Range extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'range';
    }

    /**
     * @return string
     */
    protected static function getFactory()
    {
        return 'numberBetween(1, 10)';
    }
}
