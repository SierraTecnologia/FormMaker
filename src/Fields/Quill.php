<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Quill extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'div';
    }

    /**
     * @return string[]
     *
     * @psalm-return array{style: string}
     */
    protected static function getAttributes()
    {
        return [
            'style' => 'height: 200px;'
        ];
    }

    /**
     * @return string
     */
    protected static function getFactory()
    {
        return 'text(300)';
    }

    /**
     * @return string[]
     *
     * @psalm-return array{0: string, 1: string}
     */
    protected static function stylesheets($options)
    {
        return [
            "//cdn.quilljs.com/1.3.6/quill.bubble.css",
            "//cdn.quilljs.com/1.3.6/quill.snow.css",
        ];
    }

    /**
     * @return string[]
     *
     * @psalm-return array{0: string}
     */
    protected static function scripts($options)
    {
        return ['//cdn.quilljs.com/1.3.6/quill.js'];
    }

    /**
     * @return string
     */
    protected static function js($id, $options)
    {
        $theme = $options['theme'] ?? 'snow';
        $placeholder = $options['placeholder'] ?? '';

        return <<<EOT
new Quill('#$id', {
    theme: '$theme',
    placeholder: '$placeholder'
});
EOT;
    }
}
