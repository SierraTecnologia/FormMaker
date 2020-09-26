<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Code extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'textarea';
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
        $theme = $options['theme'] ?? 'default';

        return [
            "//cdnjs.cloudflare.com/ajax/libs/codemirror/5.53.2/theme/$theme.min.css",
            "//cdnjs.cloudflare.com/ajax/libs/codemirror/5.53.2/codemirror.min.css",
        ];
    }

    /**
     * @return string[]
     *
     * @psalm-return array{0: string, 1: string, 2: string, 3: string}
     */
    protected static function scripts($options)
    {
        $mode = $options['mode'] ?? 'htmlmixed';

        return [
            '//cdnjs.cloudflare.com/ajax/libs/codemirror/5.53.2/codemirror.min.js',
            '//cdnjs.cloudflare.com/ajax/libs/codemirror/5.53.2/mode/xml/xml.min.js',
            "//cdnjs.cloudflare.com/ajax/libs/codemirror/5.53.2/mode/css/css.min.js",
            "//cdnjs.cloudflare.com/ajax/libs/codemirror/5.53.2/mode/$mode/$mode.min.js",
        ];
    }

    /**
     * @return string
     */
    protected static function js($id, $options)
    {
        $mode = $options['mode'] ?? 'htmlmixed';
        $theme = $options['theme'] ?? 'default';

        return <<<EOT
CodeMirror.fromTextArea(document.getElementById("$id"), {
    lineNumbers: true,
    mode: '$mode',
    theme: '$theme',
});
EOT;
    }
}
