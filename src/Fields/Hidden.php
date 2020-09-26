<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Hidden extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'hidden';
    }

    /**
     * @return string
     */
    protected static function getFactory()
    {
        return 'text(50)';
    }
}
