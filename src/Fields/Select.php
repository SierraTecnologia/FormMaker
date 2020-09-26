<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Select extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'select';
    }

    /**
     * @return string
     */
    protected static function getFactory()
    {
        return 'text(50)';
    }
}
