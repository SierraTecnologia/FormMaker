<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Tags extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'text';
    }

    /**
     * @return array
     *
     * @psalm-return array<empty, empty>
     */
    protected static function getAttributes()
    {
        return [];
    }

    /**
     * @return string
     */
    protected static function getFactory()
    {
        return 'text(50)';
    }

    /**
     * @return string[]
     *
     * @psalm-return array{0: string}
     */
    protected static function stylesheets($options)
    {
        return [
            '//cdn.jsdelivr.net/npm/@yaireo/tagify@3.8.0/dist/tagify.css'
        ];
    }

    /**
     * @return string[]
     *
     * @psalm-return array{0: string}
     */
    protected static function scripts($options)
    {
        return [
            '//cdn.jsdelivr.net/npm/@yaireo/tagify@3.8.0/dist/tagify.min.js'
        ];
    }

    /**
     * @return string
     */
    protected static function styles($id, $options)
    {
        $defaultBorder = $options['default-border'] ?? '#EEE';
        $focusBorder = $options['focus-border'] ?? '#EEE';

        return <<<EOT
.tagify {
    --tags-border-color: $defaultBorder;
    --tags-focus-border-color: $focusBorder;
}
EOT;
    }

    /**
     * @return string
     */
    protected static function js($id, $options)
    {
        return <<<EOT
new Tagify (document.getElementById('$id'));
EOT;
    }
}
