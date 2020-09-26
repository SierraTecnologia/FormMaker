<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class DatetimeLocal extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'datetime-local';
    }

    /**
     * @return string[]
     *
     * @psalm-return array{format: string, before: string}
     */
    protected static function getOptions()
    {
        return [
            'format' => 'Y-m-d\TH:i',
            'before' => 'Date/Time',
        ];
    }

    /**
     * @return string
     */
    protected static function getFactory()
    {
        return 'dateTime';
    }
}
