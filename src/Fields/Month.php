<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Month extends Field
{
    protected static function getType()
    {
        return 'month';
    }

    protected static function getFactory()
    {
        return 'month';
    }
}
