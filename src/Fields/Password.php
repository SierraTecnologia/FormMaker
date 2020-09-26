<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Password extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'password';
    }

    /**
     * @return string
     */
    protected static function getFactory()
    {
        return 'password';
    }
}
