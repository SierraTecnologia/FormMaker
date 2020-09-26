<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Month extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'month';
    }

    /**
     * @return string
     */
    protected static function getFactory()
    {
        return 'month';
    }
}
