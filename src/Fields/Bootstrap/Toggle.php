<?php

namespace SierraTecnologia\FormMaker\Fields\Bootstrap;

use SierraTecnologia\FormMaker\Fields\Field;

class Toggle extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'checkbox';
    }

    /**
     * @return false[]
     *
     * @psalm-return array{label: false}
     */
    protected static function getOptions()
    {
        return [
            'label' => false,
        ];
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
        return 'boolean';
    }

    /**
     * @return string[]
     *
     * @psalm-return array{0: string}
     */
    protected static function stylesheets($options)
    {
        return [
            "//cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css",
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
            '//cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js'
        ];
    }

    /**
     * @return string
     */
    protected static function js($id, $options)
    {
        $theme = $options['theme'] ?? 'light';
        $on = $options['on'] ?? 'On';
        $off = $options['off'] ?? 'Off';
        $size = $options['size'] ?? 'sm';

        return <<<EOT
$('#$id').bootstrapToggle({
    offstyle: "$theme",
    on: "$on",
    off: "$off",
    size: "$size"
});
EOT;
    }
}
