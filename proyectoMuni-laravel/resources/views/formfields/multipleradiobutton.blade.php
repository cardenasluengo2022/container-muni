
<?php $checked = false; ?>
<div class="switch-field">
@if(isset($options->options))
    @foreach($options->options as $key => $label)
        @if(isset($dataTypeContent->{$row->field}) || old($row->field))
            @php
				if ($dataTypeContent->{$row->field} == $key) {
					$checked = true;
				}else{
					$checked = false;
				}
            @endphp
        @else
            <?php $checked = isset($options->checked) && $options->checked ? true : false; ?>
        @endif

		<input type="radio" name="{{ $row->field }}" {!! $checked ? 'checked="checked"' : '' !!} value="{{$key}}" id="{{ $row->field }}-{{$key}}">
		<label for="{{ $row->field }}-{{$key}}">{{$label}}</label>
    @endforeach
@endif
</div>


	