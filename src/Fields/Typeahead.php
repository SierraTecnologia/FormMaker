<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Typeahead extends Field
{
    /**
     * Input type
     *
     * @return string
     */
    protected static function getType()
    {
        return 'text';
    }

    /**
     * Input attributes
     *
     * @return string[]
     *
     * @psalm-return array{class: string}
     */
    protected static function getAttributes()
    {
        return [
            'class' => 'typeahead form-control',
        ];
    }

    /**
     * Field maker options
     *
     * @return array
     *
     * @psalm-return array<empty, empty>
     */
    protected static function getOptions()
    {
        return [];
    }

    /**
     * @return string[]
     *
     * @psalm-return array{0: string}
     */
    protected static function stylesheets($options)
    {
        return [
            "//cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.11.0/jquery.typeahead.min.css",
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
            '//cdnjs.cloudflare.com/ajax/libs/jquery-typeahead/2.11.0/jquery.typeahead.min.js'
        ];
    }

    /**
     * @return string
     */
    protected static function getTemplate()
    {
        return <<<EOT
<div class="{rowClass}">
    <label for="{id}" class="{labelClass}">{name}</label>
    <div class="{fieldClass}">
        <div class="typeahead__container">
            <div class="typeahead__field">
                <div class="typeahead__query">{field}</div>
            </div>
        </div>
    </div>
    {errors}
</div>
EOT;
    }

    /**
     * @return string
     */
    protected static function js($id, $options)
    {
        $values = $options['matches'];

        return <<<EOT
$.typeahead({
    input: '.typeahead',
    order: "desc",
    source: {
        data: $values
    }
});
EOT;
    }
}
