<?php

namespace App;

use TCG\Voyager\FormFields\AbstractHandler;

class CustomDateFormField extends AbstractHandler
{
    protected $codename = 'CustomDate';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('formfields.customdate', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }
}
