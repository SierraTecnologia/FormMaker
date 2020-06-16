<?php

namespace SierraTecnologia\FormMaker\Html;

use SierraTecnologia\FormMaker\Html\HtmlSnippet;

class DivClose extends HtmlSnippet
{
    public static function content($options = [])
    {
        return '</div>';
    }
}
