<input type="number"
       class="form-control"
       name="{{ $row->field }}"
       data-name="{{ $row->display_name }}"
       @if($row->required == 1) required @endif
             step="any"
       placeholder="{{ isset($options->placeholder)? old($row->field, $options->placeholder): $row->display_name }}"
       value="@if(isset($dataTypeContent->{$row->field})){{ old($row->field, $dataTypeContent->{$row->field}) }}@else{{old($row->field)}}@endif">



       <div class="max-w-md mx-auto mt-8">

        //recibir lista de data
        

		<!-- Drag and drop list -->
		<div class="p-4 bg-white rounded-lg shadow-lg">
			<ul id="list" class="list-none p-0 m-0 bg-gray-100 border border-gray-300 min-h-40">
				<li id="item1" draggable="true" class="bg-white border border-gray-300 p-4 mb-2 cursor-move">Item 1</li>
				<li id="item2" draggable="true" class="bg-white border border-gray-300 p-4 mb-2 cursor-move">Item 2</li>
				<li id="item3" draggable="true" class="bg-white border border-gray-300 p-4 mb-2 cursor-move">Item 3</li>
				<li id="item4" draggable="true" class="bg-white border border-gray-300 p-4 mb-2 cursor-move">Item 4</li>
				<li id="item5" draggable="true" class="bg-white border border-gray-300 p-4 mb-2 cursor-move">Item 5</li>
			</ul>
		</div>

		<!-- Drop target -->
		<div id="target" class="mt-4 p-4 bg-white rounded-lg shadow-lg border-dashed border-2 border-gray-300 min-h-60">
			<p class="text-center text-gray-400">Drop items here</p>
		</div>

	</div>