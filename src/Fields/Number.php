<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Number extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'number';
    }

    /**
     * Get factory
     *
     * @return string
     */
    protected static function getFactory()
    {
        return 'randomNumber()';
    }
}
