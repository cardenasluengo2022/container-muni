<?php

namespace App;

use TCG\Voyager\FormFields\AbstractHandler;

class CustomTimeFormField extends AbstractHandler
{
    protected $codename = 'CustomTime';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('formfields.customtime', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }
}
