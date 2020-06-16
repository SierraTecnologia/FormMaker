<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Url extends Field
{
    protected static function getType()
    {
        return 'url';
    }

    protected static function getFactory()
    {
        return 'url';
    }
}
