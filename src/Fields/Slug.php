<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Slug extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'text';
    }

    /**
     * @return string
     */
    protected static function getFactory()
    {
        return 'text(50)';
    }

    /**
     * @return string
     */
    protected static function js($id, $options)
    {
        return <<<EOT
document.getElementById('$id')
.addEventListener("keyup", event => {
    event.preventDefault();
    let str = document.getElementById('$id').value;
    str = str.replace(/\W+(?!$)/g, '-').toLowerCase();
    document.getElementById('$id').value = str;
});
EOT;
    }
}
