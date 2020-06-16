<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Email extends Field
{
    protected static function getType()
    {
        return 'email';
    }

    protected static function getFactory()
    {
        return 'email';
    }
}
