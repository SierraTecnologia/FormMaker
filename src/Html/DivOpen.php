<?php

namespace SierraTecnologia\FormMaker\Html;

use SierraTecnologia\FormMaker\Html\HtmlSnippet;

class DivOpen extends HtmlSnippet
{
    /**
     * @return string
     */
    public static function content($options = [])
    {
        $class = '';

        if (isset($options['class'])) {
            $class = " class=\"{$options['class']}\"";
        }

        return "<div{$class}>";
    }
}
