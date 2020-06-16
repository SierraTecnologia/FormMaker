<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Telephone extends Field
{
    protected static function getType()
    {
        return 'tel';
    }

    protected static function getFactory()
    {
        return 'phone';
    }
}
