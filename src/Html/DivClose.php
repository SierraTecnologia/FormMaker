<?php

namespace SierraTecnologia\FormMaker\Html;

use SierraTecnologia\FormMaker\Html\HtmlSnippet;

class DivClose extends HtmlSnippet
{
    /**
     * @return string
     */
    public static function content($options = [])
    {
        return '</div>';
    }
}
