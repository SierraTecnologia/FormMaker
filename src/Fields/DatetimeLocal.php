<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class DatetimeLocal extends Field
{
    protected static function getType()
    {
        return 'datetime-local';
    }

    protected static function getOptions()
    {
        return [
            'format' => 'Y-m-d\TH:i',
            'before' => 'Date/Time',
        ];
    }

    protected static function getFactory()
    {
        return 'dateTime';
    }
}
