<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class FileWithPreview extends Field
{
    /**
     * @return string
     */
    protected static function getType()
    {
        return 'file';
    }

    /**
     * @return string[]
     *
     * @psalm-return array{onChange: string}
     */
    protected static function getAttributes()
    {
        return [
            'onChange' => 'window.FormMaker_previewFileUpload(this);'
        ];
    }

    /**
     * @return string
     */
    protected static function getFactory()
    {
        return 'image';
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
        {field}
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
        $preview = $options['preview_identifier'] ?? '';
        $asBackgroundImage = $options['preview_as_background_image'] ?? false;

        $method = 'document.querySelector('.$preview.')'
            .'.setAttribute(\'src\', e.target.result);';

        if ($asBackgroundImage) {
            $method = 'document.querySelector("'.$preview.'")'
                .'.setAttribute(\'style\', "background-image: url("+e.target.result+")");';
        }

        return <<<EOT
window.FormMaker_previewFileUpload = function (input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $method
        };

        reader.readAsDataURL(input.files[0]);
    }
}
EOT;
    }
}
