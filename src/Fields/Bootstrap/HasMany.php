<?php

namespace SierraTecnologia\FormMaker\Fields\Bootstrap;

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
     * @return (string|true)[]
     *
     * @psalm-return array{class: string, multiple: true}
     */
    protected static function getAttributes()
    {
        return [
            'class' => 'selectpicker',
            'multiple' => true,
        ];
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
            "//cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css",
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
            '//cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js'
        ];
    }

    /**
     * @return string
     */
    protected static function js($id, $options)
    {
        $btn = $options['btn'] ?? 'btn-primary';

        return <<<EOT
$('.selectpicker').selectpicker({
    style: "{$btn}",
}).parent().css({
    display: "block",
    width: "100%"
});
EOT;
    }
}
