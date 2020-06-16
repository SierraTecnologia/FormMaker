<?php

/*
|--------------------------------------------------------------------------
| Form Maker Config
|--------------------------------------------------------------------------
*/

return [

    'buttons' => [
        'submit' => 'btn btn-primary',
        'delete' => 'btn btn-danger',
        'cancel' => 'btn btn-secondary',
    ],

    'form' => [
        'class' => 'form',
        'delete-class' => 'form-inline',
        'inline-class' => 'form d-inline',

        'group-class' => 'form-group',
        'input-class' => 'form-control',
        'label-class' => 'control-label',
        'label-check-class' => 'form-check-label',
        'before_after_input_wrapper' => 'input-group',
        'text-error' => 'text-danger',
        'error-class' => 'has-error',
        'check-class' => 'form-check',

        'check-input-class' => 'form-check-input',
        'check-inline-class' => 'form-check form-check-inline',
        'custom-file-label' => 'custom-file-label',
        'custom-file-input-class' => 'custom-file-input',
        'custom-file-wrapper-class' => 'custom-file',

        'input-group-text' => 'input-group-text',
        'input-group-before' => 'input-group-prepend',
        'input-group-after' => 'input-group-append',

        /*
        * --------------------------------------------------------------------------
        * Form Sections
        * --------------------------------------------------------------------------
        */

        'sections' => [
            'column-base' => 'col-md-',
            'row-class' => 'row',
            'full-size-column' => 'col-md-12',
            'header-spacing' => 'mt-2 mb-2',
            'row-alignment-between' => 'd-flex justify-content-between',
            'row-alignment-end' => 'd-flex justify-content-end',
        ],

        /*
         * --------------------------------------------------------------------------
         * For Horizontal forms
         * --------------------------------------------------------------------------
         *  You may wish to use horizontal forms. If you do, you need to set the
         *  orientation to horizontal, and ensure that your form has the 'form-horizontal'
         *  class.
        */

        'orientation' => 'vertical',
        'horizontal-class' => 'form-horizontal',
        'label-column' => 'col-md-2 col-form-label pt-0',
        'input-column' => 'col-md-10',
    ]

];
