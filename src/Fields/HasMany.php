<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class HasMany extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'relationship';
    }

    /**
     * @return true[]
     *
     * @psalm-return array{multiple: true}
     */
    protected static function getAttributes()
    {
        return [
            'multiple' => true,
        ];
    }

    /**
     * @return null
     */
    protected static function getFactory()
    {
        return null;
    }
}
