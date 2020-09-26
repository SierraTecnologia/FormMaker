<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Time extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'time';
    }

    /**
     * @return string
     */
    protected static function getFactory()
    {
        return 'time';
    }
}
