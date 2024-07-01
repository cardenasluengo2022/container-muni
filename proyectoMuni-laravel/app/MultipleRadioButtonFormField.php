<?php

namespace App;

use TCG\Voyager\FormFields\AbstractHandler;

class MultipleRadioButtonFormField extends AbstractHandler
{
    protected $codename = 'MultipleRadioButton';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('formfields.multipleradiobutton', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }
}
