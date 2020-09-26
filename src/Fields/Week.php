<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Week extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'week';
    }

    /**
     * @return string
     */
    protected static function getFactory()
    {
        return 'week';
    }
}
