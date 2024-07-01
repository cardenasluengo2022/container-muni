@php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .dropzone {
            padding: 2ch;
            border: 1px dashed gray;
            overflow-y:scroll; 
            position:relative;
        }

        .draggable {
            border: 1px solid lightgray;
            padding: 1.5ch;
            background-color: #efefef;
            cursor: move;
        }
        .draggable + .draggable {
            margin-top: 1.5ch;
        }
        .draggable.is-dragging {
            opacity: 0.5;
        }

        /**/

        .dropzone2 {
            padding: 2ch;
            border: 1px dashed gray;
            overflow-y:scroll; 
            position:relative;
        }

        .draggable2 {
            border: 1px solid lightgray;
            padding: 1.5ch;
            background-color: #efefef;
            cursor: move;
        }
        .draggable2 + .draggable2 {
            margin-top: 1.5ch;
        }
        .draggable2.is-dragging {
            opacity: 0.5;
        }

        .voyager .panel.panel-success .panel-heading {
            background-color: green;
        }
        .voyager .panel.panel-success {
            border: 0px solid #1abc9c;
        }

       

        /*Radio toggle*/

        .switch-field {
            display: flex;
            overflow: hidden;
        }

        .switch-field input {
            position: absolute !important;
            clip: rect(0, 0, 0, 0);
            height: 1px;
            width: 1px;
            border: 0;
            overflow: hidden;
        }

        .switch-field label {
            background-color: #f0f0f0;
            color: rgba(0, 0, 0, 0.6);
            font-size: 14px;
            font-weight: bold;
            line-height: 1;
            text-align: center;
            padding: 8px 16px;
            margin-right: -1px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
            transition: all 0.1s ease-in-out;
        }

        .switch-field label:hover {
            cursor: pointer;
        }

        .switch-field input:checked + label {
            background-color: #22a7f0;
            color: #fff;
            box-shadow: none;
        }

        .switch-field label:first-of-type {
            border-radius: 4px 0 0 4px;
        }

        .switch-field label:last-of-type {
            border-radius: 0 4px 4px 0;
        }
        

    </style>
    <!-- Estilo Encabezados de secciones -->
    <style>
        .text-white{
            color: #fff;
        }
        .mb-10{
           margin-bottom: 10px !important; 
        }
        .mb-20{
           margin-bottom: 20px !important; 
        }
        .mb-30{
           margin-bottom: 30px !important; 
        }
        .mt-10{
           margin-top: 10px !important; 
        }
        .mt-20{
           margin-top: 20px !important; 
        }
        .mt-30{
           margin-top: 30px !important; 
        }
        .em {
            margin-left: 15px;
            font-size: 14px;
            color: gold;
        }
    </style>
    <!-- Fin Estilo Encabezados de secciones -->
@stop

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form"
                            class="form-edit-add"
                            action="{{ $edit ? route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) : route('voyager.'.$dataType->slug.'.store') }}"
                            method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                        @if($edit)
                            {{ method_field("PUT") }}
                        @endif

                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Adding / Editing -->
                            @php
                                $dataTypeRows = $dataType->{($edit ? 'editRows' : 'addRows' )};
                            @endphp

                            @foreach($dataTypeRows as $row)
                                <!-- GET THE DISPLAY OPTIONS -->
                                @php
                                    $display_options = $row->details->display ?? NULL;
                                    if ($dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')}) {
                                        $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')};
                                    }
                                @endphp

                                <!-- Encabezados de secciones -->
                                    @if(isset($display_options->head))
                                        <div class="panel-heading bg-primary col-md-12 mb-20 mt-10">
                                            <h3 class="panel-title text-white">{{$display_options->head_tittle}}
                                                @isset($display_options->head_info)
                                                    <em class="em"><i class="voyager-info-circled"></i> {{$display_options->head_info}}</em>
                                                @endisset
                                            </h3>
                                            
                                        </div>
                                    @endif 

                                <!-- Fin Encabezados de secciones --> 
                                
                                

                                @if (isset($row->details->legend) && isset($row->details->legend->text))
                                    <legend class="text-{{ $row->details->legend->align ?? 'center' }}" style="background-color: {{ $row->details->legend->bgcolor ?? '#f0f0f0' }};padding: 5px;">{{ $row->details->legend->text }}</legend>
                                @endif


                                <div class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                    {{ $row->slugify }}

                                    <label class="control-label" for="name">{{ $row->getTranslatedAttribute('display_name') }}</label>
                                    @include('voyager::multilingual.input-hidden-bread-edit-add')
                                    @if ($add && isset($row->details->view_add))
                                        @include($row->details->view_add, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'view' => 'add', 'options' => $row->details])
                                    @elseif ($edit && isset($row->details->view_edit))
                                    
                                        @include($row->details->view_edit, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'view' => 'edit', 'options' => $row->details])
                                    @elseif (isset($row->details->view))
                                        @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => ($edit ? 'edit' : 'add'), 'view' => ($edit ? 'edit' : 'add'), 'options' => $row->details])
                                    @elseif ($row->type == 'relationship')
                                   
                                        @include('voyager::formfields.relationship', ['options' => $row->details])
                                    @else
                                    
                                        @if ($row->field == "portada_contenido")
                                        <!-- Inicio Drag and Drop Portada-->  
                                            <input type="hidden" name="portada_contenido" id="portada_contenido_txt" 
                                                @if(isset($dataTypeContent) && ( $dataTypeContent->portada_contenido != null || $dataTypeContent->portada_contenido != "") )
                                                    value="{{ json_decode($dataTypeContent->portada_contenido) }}"
                                                @else
                                                value=''
                                                @endif
                                            >
                                        
                                            <p>
                                                <em>Arrastre el contenido que quiera mostrar en la sección Portada hacia el cuadro de su derecha</em>
                                            </p>
                                            <div class="row">
                                                <div class="panel panel-bordered panel-primary col-md-6 overflow-auto">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title">Contenido Disponible</h3>
                                                    </div>
                                                    <div class="panel-body row">
                                                        <section class="dropzone source col-12 overflow-auto" style="height: 200px">
                                                            @foreach ($arreglo as $a => $k)
                                                                <div class="draggable" id="{{$a}}" draggable="true">{{$k}} </div>
                                                            @endforeach
                                                        
                                                        </section>
                                                    </div>
                                                </div>
        
                                                <div class="panel panel-bordered panel-success col-md-6 overflow-auto">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title">Contenido para mostrar en Sección Portada</h3>
                                                    </div>
                                                    <div class="panel-body row">
                                                        <section class="dropzone target col-12 overflow-auto" style="height: 200px">
                                                            @foreach ($portada_contenido as $a => $k)
                                                                <div class="draggable" id="{{$a}}" draggable="true">{{$k}}</div>
                                                            @endforeach
                                                        </section>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- fin Drag and Drop Portada-->
                                        
                                        @elseif($row->field == "segundaria_contenido")
                                        <!-- Inicio Drag and Drop segundaria--> 
                                            <input type="hidden" name="segundaria_contenido" id="segundaria_contenido_txt" 
                                                @if(isset($dataTypeContent) && ( $dataTypeContent->segundaria_contenido != null || $dataTypeContent->segundaria_contenido != "") )
                                                    value="{{ json_decode($dataTypeContent->segundaria_contenido) }}"
                                                @else
                                                value=''
                                                @endif
                                            >
                                        
                                            <p>
                                                <em>Arrastre el contenido que quiera mostrar en la sección Segundaria hacia el cuadro de su derecha</em>
                                            </p>

                                            <div class="row">
                                                <div class="panel panel-bordered panel-primary col-md-6 overflow-auto">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title">Contenido Disponible</h3>
                                                    </div>
                                                    <div class="panel-body row">
                                                        <section class="dropzone2 source2 col-12 overflow-auto" style="height: 200px">
                                                            @foreach ($arreglo2 as $a => $k)
                                                                <div class="draggable2" id="{{$a}}|2" draggable="true">{{$k}} </div>
                                                            @endforeach
                                                        
                                                        </section>
                                                    </div>
                                                </div>
        
                                                <div class="panel panel-bordered panel-success col-md-6 overflow-auto">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title">Contenido para mostrar en Sección Segundaria</h3>
                                                    </div>
                                                    <div class="panel-body row">
                                                        <section class="dropzone2 target2 col-12 overflow-auto" style="height: 200px">
                                                            @foreach ($segundaria_contenido as $a => $k)
                                                                <div class="draggable2" id="{{$a}}|2" draggable="true">{{$k}}</div>
                                                            @endforeach
                                                        </section>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- fin Drag and Drop segundaria-->
                                        @else 
                                            {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                        @endif
                                    @endif

                                    @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                        {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                    @endforeach
                                    @if ($errors->has($row->field))
                                        @foreach ($errors->get($row->field) as $error)
                                            <span class="help-block">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            @section('submit-buttons')
                                <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                            @stop
                            @yield('submit-buttons')
                        </div>
                    </form>

                    <div style="display:none">
                        <input type="hidden" id="upload_url" value="{{ route('voyager.upload') }}">
                        <input type="hidden" id="upload_type_slug" value="{{ $dataType->slug }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>
        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
          return function() {
            $file = $(this).siblings(tag);

            params = {
                slug:   '{{ $dataType->slug }}',
                filename:  $file.data('file-name'),
                id:     $file.data('id'),
                field:  $file.parent().data('field-name'),
                multi: isMulti,
                _token: '{{ csrf_token() }}'
            }

            $('.confirm_delete_name').text(params.filename);
            $('#confirm_delete_modal').modal('show');
          };
        }

        $('document').ready(function () {

            $('input[name=switch-two]').click(function() {
                //alert($('input[name=gender]:checked').val());
                console.log(document.querySelector('input[name="switch-two"]:checked').value);
            });


            $('.toggleswitch').bootstrapToggle();

            @if(isset($dataTypeContent->header_chek) && $dataTypeContent->header_chek == 0)
                $("#header_rrss").hide();
                $("#header_datos").hide();
                $("#header_color").hide();
                $("#header_altura").hide();
            @endif

            @if(isset($dataTypeContent->portada_chek) && $dataTypeContent->portada_chek == 0)
                $("#portada_contentCheck").hide();
                $("#portada_titulo").hide();
                $("#portada_subtitulo").hide();
                $("#portada_imagen").hide();
                $("#portada_contentList").hide();
            @endif

            @if(isset($dataTypeContent->portada_content_chek) && $dataTypeContent->portada_content_chek == 0)
                $("#portada_titulo").hide();
                $("#portada_subtitulo").hide();
                $("#portada_imagen").hide();
            @elseif(isset($dataTypeContent->portada_content_chek) && $dataTypeContent->portada_content_chek == 1)
                $("#portada_titulo").show();
                $("#portada_subtitulo").show();
                $("#portada_imagen").show();
                $("#portada_contentList").hide();
            @endif


            @if(isset($dataTypeContent->segundaria_chek) && $dataTypeContent->segundaria_chek == 0)
                $("#segundaria_contentList").hide();
            @endif

            @if(isset($dataTypeContent->alerta_chek) && $dataTypeContent->alerta_chek == 0)
                $("#alerta_titulo").hide();
                $("#alerta_subtitulo").hide();
                $("#alerta_mapa").hide();
            @endif

            @if(isset($dataTypeContent->newlister_chek) && $dataTypeContent->newlister_chek == 0)
                $("#newlister_titulo").hide();
                $("#newlister_subtitulo").hide();
            @endif

            @if(isset($dataTypeContent->emprendimientos_chek) && $dataTypeContent->emprendimientos_chek == 0)
                $("#emprendimientos_titulo").hide();
                $("#emprendimientos_subtitulo").hide();
                $("#inscripcion_check").hide();
            @endif

            @if(isset($dataTypeContent->footer_chek) && $dataTypeContent->footer_chek == 0)
                $("#footer_titulo").hide();
                $("#footer_subtitulo").hide();
                $("#footer_contentList").hide();
            @endif



            $('input[name=header_chek]').change(function () {
               if (this.checked) {
                $("#header_rrss").show();
                $("#header_datos").show();
                $("#header_color").show();
                $("#header_altura").show();
               }else{
                $("#header_rrss").hide();
                $("#header_datos").hide();
                $("#header_color").hide();
                $("#header_altura").hide();
               }
            });

            $('input[name=portada_chek]').change(function () {
               if (this.checked) {
                $("#portada_contentCheck").show();
                
                if ($('input[name=portada_content_chek]').checked == true) {
                    $("#portada_titulo").show();
                    $("#portada_subtitulo").show();
                    $("#portada_imagen").show();
                    $("#portada_contentList").hide();
                } else {
                    $("#portada_titulo").hide();
                    $("#portada_subtitulo").hide();
                    $("#portada_imagen").hide();
                    $("#portada_contentList").show();
                }

               }else{
                
                $("#portada_contentCheck").hide();
                $("#portada_titulo").hide();
                $("#portada_subtitulo").hide();
                $("#portada_imagen").hide();
                $("#portada_contentList").hide();
               }
                
            });

            $('input[name=portada_content_chek]').change(function () {
               if (this.checked) {
                $("#portada_titulo").show();
                $("#portada_subtitulo").show();
                $("#portada_imagen").show();
                $("#portada_contentList").hide();
               }else{
                $("#portada_titulo").hide();
                $("#portada_subtitulo").hide();
                $("#portada_imagen").hide();
                $("#portada_contentList").show();
               }
                
            });

            $('input[name=segundaria_chek]').change(function () {
               if (this.checked) {
                $("#segundaria_contentList").show();
               }else{
                $("#segundaria_contentList").hide();
               }
                
            });

            $('input[name=alerta_chek]').change(function () {
               if (this.checked) {
                $("#alerta_titulo").show();
                $("#alerta_subtitulo").show();
                $("#alerta_mapa").show();
               }else{
                $("#alerta_titulo").hide();
                $("#alerta_subtitulo").hide();
                $("#alerta_mapa").hide();
               }
                
            });

            $('input[name=newlister_chek]').change(function () {
               if (this.checked) {
                $("#newlister_titulo").show();
                $("#newlister_subtitulo").show();
               }else{
                $("#newlister_titulo").hide();
                $("#newlister_subtitulo").hide();
               }
            });

            $('input[name=emprendimientos_chek]').change(function () {
               if (this.checked) {
                $("#emprendimientos_titulo").show();
                $("#emprendimientos_subtitulo").show();
                $("#inscripcion_check").show();
               }else{
                $("#emprendimientos_titulo").hide();
                $("#emprendimientos_subtitulo").hide();
                $("#inscripcion_check").hide();
               }
                
            });

            $('input[name=footer_chek]').change(function () {
               if (this.checked) {
                $("#footer_titulo").show();
                $("#footer_subtitulo").show();
                $("#footer_contentList").show();
               }else{
                $("#footer_titulo").hide();
                $("#footer_subtitulo").hide();
                $("#footer_contentList").hide();
               }
                
            });

            

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                } else if (elt.type != 'date') {
                    elt.type = 'text';
                    $(elt).datetimepicker({
                        format: 'L',
                        extraFormats: [ 'YYYY-MM-DD' ]
                    }).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable)
                $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.'.$dataType->slug.'.media.remove') }}', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        const dropzoneSource = document.querySelector(".source");
        const dropzone = document.querySelector(".target");
        const dropzones = [...document.querySelectorAll(".dropzone")];
        const draggables = [...document.querySelectorAll(".draggable")];

        function getDragAfterElement(container, y) {
        const draggableElements = [
            ...container.querySelectorAll(".draggable:not(.is-dragging)")
        ];

        return draggableElements.reduce(
            (closest, child) => {
            const box = child.getBoundingClientRect();
            const offset = y - box.top - box.height / 2;

            if (offset < 0 && offset > closest.offset) {
                return {
                offset,
                element: child
                };
            } else {
                return closest;
            }
            },
            { offset: Number.NEGATIVE_INFINITY }
        ).element;
        }

        draggables.forEach((draggable) => {
        draggable.addEventListener("dragstart", (e) => {
            draggable.classList.add("is-dragging");
        });

        draggable.addEventListener("dragend", (e) => {
            draggable.classList.remove("is-dragging");
            let lista = dropzone.querySelectorAll('div.draggable');
            let elementos = [];
            lista.forEach(ele => {
                
                elementos.push(ele.id);
            });
            document.querySelector("#portada_contenido_txt").value = JSON.stringify(elementos);
            console.log(JSON.stringify(elementos) );
            
        });
        });

        dropzones.forEach((zone) => {
        zone.addEventListener("dragover", (e) => {
            e.preventDefault();
            const afterElement = getDragAfterElement(zone, e.clientY);
            const draggable = document.querySelector(".is-dragging");
            if (afterElement === null) {
            zone.appendChild(draggable);
            } else {
            zone.insertBefore(draggable, afterElement);
            }
        });
        });

    </script>
    <script>
        const dropzoneSource2 = document.querySelector(".source2");
        const dropzone2 = document.querySelector(".target2");
        const dropzones2 = [...document.querySelectorAll(".dropzone2")];
        const draggables2 = [...document.querySelectorAll(".draggable2")];

        function getDragAfterElement(container, y) {
        const draggableElements2 = [
            ...container.querySelectorAll(".draggable2:not(.is-dragging)")
        ];

        return draggableElements2.reduce(
            (closest, child) => {
            const box = child.getBoundingClientRect();
            const offset = y - box.top - box.height / 2;

            if (offset < 0 && offset > closest.offset) {
                return {
                offset,
                element: child
                };
            } else {
                return closest;
            }
            },
            { offset: Number.NEGATIVE_INFINITY }
        ).element;
        }

        draggables2.forEach((draggable) => {
        draggable.addEventListener("dragstart", (e) => {
            draggable.classList.add("is-dragging");
        });

            draggable.addEventListener("dragend", (e) => {
                draggable.classList.remove("is-dragging");
                let lista = dropzone2.querySelectorAll('div.draggable2');
                let elementos = [];
                lista.forEach(ele => {
                    
                    elementos.push(ele.id);
                });

                let elementos2 = [];
                elementos.forEach(e => {
                    const c = e.split('|');
                    elementos2.push(c[0]+'|'+c[1]);
                });
                document.querySelector("#segundaria_contenido_txt").value = JSON.stringify(elementos2);
                
            });
        });

        dropzones2.forEach((zone) => {
        zone.addEventListener("dragover", (e) => {
            e.preventDefault();
            const afterElement = getDragAfterElement(zone, e.clientY);
            const draggable = document.querySelector(".is-dragging");
            if (afterElement === null) {
            zone.appendChild(draggable);
            } else {
            zone.insertBefore(draggable, afterElement);
            }
        });
        });

    </script>
@stop
