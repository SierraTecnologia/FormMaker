<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class TextArea extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'textarea';
    }

    /**
     * @return int[]
     *
     * @psalm-return array{rows: int}
     */
    protected static function getAttributes()
    {
        return [
            'rows' => 5,
        ];
    }

    /**
     * @return string
     */
    protected static function getFactory()
    {
        return 'text(300)';
    }
}
