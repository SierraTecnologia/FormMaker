<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Telephone extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'tel';
    }

    /**
     * @return string
     */
    protected static function getFactory()
    {
        return 'phone';
    }
}
