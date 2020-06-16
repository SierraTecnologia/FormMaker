<?php

namespace SierraTecnologia\FormMaker\Fields;

use SierraTecnologia\FormMaker\Fields\Field;

class Datepicker extends Field
{
    protected static function getType()
    {
        return 'text';
    }

    protected static function getOptions()
    {
        return [
            'before' => 'Date',
        ];
    }

    protected static function getFactory()
    {
        return 'date';
    }

    protected static function stylesheets($options)
    {
        return [
            "//unpkg.com/js-datepicker/dist/datepicker.min.css",
        ];
    }

    protected static function scripts($options)
    {
        return [
            '//unpkg.com/js-datepicker',
            '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.25.3/moment.min.js',
        ];
    }

    protected static function styles($id, $options)
    {
        $theme = $options['theme'] ?? 'light';

        $background = $options['background-color'] ?? '#FFF';
        $color = $options['color'] ?? '#FFF';
        $numberColor = $options['number-color'] ?? '#111';
        $highlight = $options['highlight'] ?? 'var(--primary, "#EEE")';
        $header = $options['header'] ?? 'var(--primary, "#EEE")';

        if ($theme != 'light' && $background == '#FFF') {
            $background = $options['background-color'] ?? '#111';
        }

        if ($theme != 'light' && $color == '#FFF') {
            $color = $options['color'] ?? '#FFF';
        }

        if ($theme != 'light' && $numberColor == '#111') {
            $numberColor = $options['number-color'] ?? '#FFF';
        }

        return <<<EOT
.qs-datepicker-container {
    color: $numberColor;
    background-color: $background;
}
.qs-datepicker .qs-controls {
    background-color: $header;
    color: $color;
    height: 35px;
}
.qs-datepicker .qs-square {
    height: 32px;
}
.qs-datepicker .qs-square.qs-active {
    background-color: $highlight;
    color: $color;
}
.qs-datepicker .qs-square:not(.qs-empty):not(.qs-disabled):not(.qs-day):not(.qs-active):hover {
    background-color: $highlight;
    color: $color;
}
.qs-datepicker .qs-arrow.qs-left:after {
    border-right-color: $color;
}
.qs-datepicker .qs-arrow.qs-right:after {
    border-left-color: $color;
}
EOT;
    }

    protected static function js($id, $options)
    {
        $startDay = $options['start-day'] ?? 1;
        $format = $options['format'] ?? 'YYYY-MM-DD';

        return <<<EOT
datepicker("#$id", {
  startDay: $startDay,
  dateSelected: moment(document.getElementById("$id").value).toDate(),
  formatter: (input, date, instance) => {
      input.value = moment(date).format("$format");
  }
})
EOT;
    }
}
