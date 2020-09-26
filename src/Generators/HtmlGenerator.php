<?php

namespace SierraTecnologia\FormMaker\Generators;

use SierraTecnologia\FormMaker\Services\InputCalibrator;

/**
 * Generate the CRUD.
 */
class HtmlGenerator
{
    /*
    |--------------------------------------------------------------------------
    | Standard HTML Inputs
    |--------------------------------------------------------------------------
    */

    /**
     * Make a select input.
     *
     * @param array  $config
     * @param string $selected
     * @param mixed  $custom
     *
     * @return string
     */
    public function makeSelected($config, $selected, $custom): string
    {
        $options = $prefix = $suffix = '';

        if (isset($config['config']['multiple'])) {
            $custom = 'multiple';
            $config['name'] = $config['name'].'[]';
        }

        if (\Illuminate\Support\Facades\Config::get('form-maker.form.orientation') === 'horizontal') {
            $prefix = '<div class="'.\Illuminate\Support\Facades\Config::get('form-maker.form.input-column').'">';
            $suffix = '</div>';
        }

        foreach ($config['config']['options'] as $key => $value) {
            $selectedValue = '';

            if (isset($config['config']['multiple']) && is_object($selected)) {
                if (in_array($value, $selected->toArray())) {
                    $selectedValue = 'selected';
                }
            } else {
                if ($selected == '') {
                    $selectedValue = ((string) $config['objectValue'] === (string) $value) ? 'selected' : '';
                } else {
                    if (isset($config['objectValue']) && is_array(json_decode($config['objectValue']))) {
                        $selectedValue = (in_array($value, json_decode($config['objectValue']))) ? 'selected' : '';
                    } else {
                        $selectedValue = ((string) $selected === (string) $value) ? 'selected' : '';
                    }
                }
            }

            $options .= '<option value="'.$value.'" '.$selectedValue.'>'.$key.'</option>';
        }

        return $prefix.'<select '.$this->processCustom($custom).' id="'.$this->getId($config).'" class="'.$config['class'].'" name="'.$config['name'].'">'.$options.'</select>'.$suffix;
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship based
    |--------------------------------------------------------------------------
    */

    /**
     * Make a relationship input.
     *
     * @param array  $config
     * @param string $label
     * @param string $value
     * @param mixed  $custom
     *
     * @return string
     */
    public function makeRelationship($config, $label = 'name', $value = 'id', $custom = '')
    {
        $object = $config['object'];

        if (isset($config['config']['relationship'])) {
            $relationship = $config['config']['relationship'];
        } else {
            $relationship = $config['name'];
        }

        // Removes the array indication for select multiple
        $relationship = str_replace('[]', '', $relationship);

        $method = 'all';

        if (!is_object($config['config']['model'])) {
            $class = app()->make($config['config']['model']);
        } else {
            $class = $config['config']['model'];
        }

        if (isset($config['config']['method'])) {
            $method = $config['config']['method'];
        }

        if (isset($config['config']['params'])) {
            $items = $class->$method($config['config']['params']);
        } else {
            $items = $class->$method();
        }

        if (isset($config['config']['nullable']) && $config['config']['nullable'] === true) {
            $config['config']['options']['- Select -'] = null;
        }
        foreach ($items as $item) {
            $config['config']['options'][$item->$label] = $item->$value;
        }

        if (!isset($config['config']['selected'])) {
            if (!isset($config['config']['multiple'])) {
                $selected = '';

                if (is_object($object) && method_exists($object, $relationship)) {
                    if ($object->$relationship()->first()) {
                        $selected = $object->$relationship()->first()->$value;
                    }
                }

                $relationship = str_replace('_id', '', $relationship);

                if (method_exists($object, $relationship)) {
                    if ($object->$relationship()->first()) {
                        $selected = $object->$relationship()->first()->$value;
                    }
                }
            } else {
                $selected = $class->$method()->pluck($value, $label);
            }
        } else {
            $selected = $config['config']['selected'];
        }

        return $this->makeSelected($config, $selected, $custom);
    }

    /**
     * Generate a standard HTML input string.
     *
     * @param array $config Config array
     *
     * @return string
     */
    public function makeHTMLInputString($config): string
    {
        $custom = $this->getCustom($config);
        $multiple = $this->isMultiple($config, 'multiple');
        $multipleArray = $this->isMultiple($config, '[]');
        $floatingNumber = $this->getFloatingNumber($config);
        $population = $this->getPopulation($config);

        if (is_array($config['objectValue']) && $config['type'] === 'file') {
            $population = '';
        }

        $inputString = '<input '.$this->processCustom($custom).' id="'.$this->getId($config).'" class="'.$config['class'].'" type="'.$config['type'].'" name="'.$config['name'].$multipleArray.'" '.$floatingNumber.' '.$multiple.' '.$population.' placeholder="'.$config['placeholder'].'">';

        return $inputString;
    }

    /**
     * Is the config a multiple?
     *
     * @param array  $config
     * @param string $response
     *
     * @return string
     */
    public function isMultiple($config, $response): string
    {
        if (isset($config['config']['multiple'])) {
            return $response;
        }

        return '';
    }

    /**
     * Get the population.
     *
     * @param array $config
     *
     * @return string
     */
    public function getPopulation($config)
    {
        if ($config['populated'] && ($config['name'] !== $config['objectValue'])) {

            if ($config['type'] == 'date' && method_exists($config['objectValue'], 'format')) {
                $format = (isset($config['format'])) ? $config['format'] : 'Y-m-d';
                $config['objectValue'] = $config['objectValue']->format($format);
            }

            if (is_array($config['objectValue'])) {
                dd('nao cair aqui, array', $config['objectValue']);
            }

            return 'value="'.htmlspecialchars($config['objectValue']).'"';
        }

        return '';
    }

    /**
     * Get an items ID
     *
     * @param array $config
     *
     * @return string
     */
    public function getId($config)
    {
        return app(InputCalibrator::class)->getId($config['name'], $config);
    }

    /**
     * Get the custom details.
     *
     * @param array $config
     *
     * @return string
     */
    public function getCustom($config)
    {
        if (isset($config['config']['custom'])) {
            return $config['config']['custom'];
        }

        return '';
    }

    /**
     * Get the floating number.
     *
     * @param array $config
     *
     * @return string
     */
    public function getFloatingNumber($config): string
    {
        if ($config['inputType'] === 'float' || $config['inputType'] === 'decimal') {
            return 'step="any"';
        }

        return '';
    }

    /**
     * Process custom attributes since there can be many
     *
     * @param mixed $custom
     *
     * @return string
     */
    public function processCustom($custom)
    {
        if (is_array($custom)) {
            return implode(' ', $custom);
        }

        return $custom;
    }
}
