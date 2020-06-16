<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Password extends Field
{
    protected static function getType()
    {
        return 'password';
    }

    protected static function getFactory()
    {
        return 'password';
    }
}
