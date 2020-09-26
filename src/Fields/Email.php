<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Email extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'email';
    }

    /**
     * @return string
     */
    protected static function getFactory()
    {
        return 'email';
    }
}
