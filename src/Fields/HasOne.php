<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class HasOne extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'relationship';
    }

    /**
     * @return null
     */
    protected static function getFactory()
    {
        return null;
    }
}
