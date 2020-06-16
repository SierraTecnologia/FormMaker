<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Week extends Field
{
    protected static function getType()
    {
        return 'week';
    }

    protected static function getFactory()
    {
        return 'week';
    }
}
