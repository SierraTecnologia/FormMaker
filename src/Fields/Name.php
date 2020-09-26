<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Name extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'text';
    }

    /**
     * @return string
     */
    protected static function getFactory()
    {
        return 'name';
    }
}
