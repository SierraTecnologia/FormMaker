<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Time extends Field
{
    protected static function getType()
    {
        return 'time';
    }

    protected static function getFactory()
    {
        return 'time';
    }
}
