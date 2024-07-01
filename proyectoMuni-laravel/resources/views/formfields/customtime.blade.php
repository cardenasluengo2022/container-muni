@php
$display_options = $row->details->display ?? NULL;
@endphp
<div class="form-group">
    <div class='input-group date' @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
        <i class="glyphicon glyphicon-time"></i>
        <input type="text" class="form-control" name="{{ $row->field }}"
            placeholder="{{ $row->getTranslatedAttribute('display_name') }}"
            value="@if(isset($dataTypeContent->{$row->field})){{ \Carbon\Carbon::parse(old($row->field, $dataTypeContent->{$row->field}))->format('H:i') }}@else{{old($row->field)}}@endif">
        
    </div>
</div>