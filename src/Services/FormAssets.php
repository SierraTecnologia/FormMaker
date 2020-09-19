<?php

namespace SierraTecnologia\FormMaker\Services;

class FormAssets
{
    public $stylesheets = [];

    public $scripts = [];

    public $styles = [];

    public $js = [];

    /**
     * Render the form assets
     *
     * @return string
     */
    public function render()
    {
        $output = '';

        $output .= collect($this->stylesheets)->unique()->implode("\n");
        $output .= collect($this->scripts)->unique()->implode("\n");

        $styles = collect($this->styles)->unique()->implode("\n");
        $output .= "<style>\n{$styles}\n</style>\n";

        $js = collect($this->js)->unique()->implode("\n");
        $output .= "<script>\n{$js}\n</script>\n";

        return $output;
    }

    /**
     * Add field stylesheets to a form
     *
     * @param  array $stylesheets
     * @return self
     */
    public function addStylesheets($stylesheets)
    {
        foreach ($stylesheets as $sheet) {
            $this->stylesheets[] = '<link href="' . $sheet . '" rel="stylesheet">';
        }

        return $this;
    }

    /**
     * Add field scripts to a form
     *
     * @param  array $scripts
     * @return self
     */
    public function addScripts($scripts)
    {
        foreach ($scripts as $script) {
            $this->scripts[] = '<script src="'.$script.'"></script>';
        }

        return $this;
    }

    /**
     * Add field Styles code to a form
     *
     * @param  string $styles
     * @return self
     */
    public function addStyles($styles)
    {
        if (!is_null($styles)) {
            $this->styles[] = $styles;
        }

        return $this;
    }

    /**
     * Add field JS code to a form
     *
     * @param  string $js
     * @return self
     */
    public function addJs($js)
    {
        if (!is_null($js)) {
            $this->js[] = $js;
        }

        return $this;
    }
}
