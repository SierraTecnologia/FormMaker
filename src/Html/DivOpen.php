<?php

namespace SierraTecnologia\FormMaker\Html;

use SierraTecnologia\FormMaker\Html\HtmlSnippet;

class DivOpen extends HtmlSnippet
{
    public static function content($options = [])
    {
        $class = '';

        if (isset($options['class'])) {
            $class = " class=\"{$options['class']}\"";
        }

        return "<div{$class}>";
    }
}
