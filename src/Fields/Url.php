<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Url extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'url';
    }

    /**
     * @return string
     */
    protected static function getFactory()
    {
        return 'url';
    }
}
