<?php

namespace SierraTecnologia\FormMaker\Html;

use SierraTecnologia\FormMaker\Html\HtmlSnippet;

class Heading extends HtmlSnippet
{
    /**
     * @return string
     */
    public static function content($options = [])
    {
        $class = '';
        $content = '';
        $level = 3;

        if (isset($options['class'])) {
            $class = " class=\"{$options['class']}\"";
        }

        if (isset($options['content'])) {
            $content = $options['content'];
        }

        if (isset($options['level'])) {
            $level = $options['level'];
        }

        throw_if(empty($content), 'You cannot have an empty heading');

        return "<h{$level}{$class}>{$content}</h{$level}>";
    }
}
