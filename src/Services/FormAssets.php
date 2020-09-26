<?php

namespace SierraTecnologia\FormMaker\Services;

class FormAssets
{
    public $stylesheets = [];

    public $scripts = [];

    public $styles = [];

    public $js = [];

    /**
     * Add field stylesheets to a form
     *
     * @param  array $stylesheets
     * @return self
     */
    public function addStylesheets($stylesheets): self
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
    public function addScripts($scripts): self
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
    public function addStyles($styles): self
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
    public function addJs($js): self
    {
        if (!is_null($js)) {
            $this->js[] = $js;
        }

        return $this;
    }
}
