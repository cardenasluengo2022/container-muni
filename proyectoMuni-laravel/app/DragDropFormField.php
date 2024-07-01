<?php

namespace App;

use TCG\Voyager\FormFields\AbstractHandler;

class DragDropFormField extends AbstractHandler
{
    protected $codename = 'DragDropList';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('formfields.dragdroplist', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }
}
