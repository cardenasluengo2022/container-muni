<section id="featured" class="featured">
    <div class="container">

      <div class="row">
        @if ($configP->destacados_busqueda != "false")
        <div class="{{$configP->destacados_busqueda}}" 
          @if ($configP->destacados_busqueda == "col-md-12")
            style="margin-bottom: 30px;"
          @else
            style="margin-bottom: 30px; min-height: 354px; max-height: 354px"
          @endif
          >
          <div class="icon-box">
            
            <h3>
              <i class="bi bi-search" style="display:inline !important; margin-right:5px;"></i>
              <a href="">En que te podemos ayudar?</a>
            </h3>
            <p id="formBuscar">
                <form action="" method="post" style="margin-top: 30px; 
                                                    background: #fff; 
                                                    padding: 6px 10px; 
                                                    position: relative; 
                                                    border-radius: 50px;
                                                    border: solid 1px {{$config->color_principal}};">
                <input type="text" id="inputSearch" name="text" style="border: 0; padding: 8px; width: calc(100% - 140px);">
                <input type="submit" value="Buscar" style="position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                border: 0;
                background: none;
                font-size: 16px;
                padding: 0 30px;
                margin: 3px;
                background: {{$config->color_principal}};
                color: #fff;
                transition: 0.3s;
                border-radius: 50px;" >
              </form>
            </p>
          </div>
        </div>
        @endif

        @foreach ($tipos as $t)
        @php
          $configTipo = "destacados_".strtolower(explode(" ", $t->tipo)[0]) ;
        @endphp
        @if (isset($configP->{$configTipo}) && $configP->{$configTipo} != "false")
        <div class="{{ $configP->{$configTipo} }} col-sm-12" style="min-height: 354px; max-height: 354px">
          <div class="icon-box">
            <i class="{{$t->icono}}"></i>
            <h3><a href="">{{$t->tipo}}</a></h3>
            <p>
                <ol class="list-group list-group-flush">
                  @foreach ($t->comunicados as $c)
                    <li class="list-group-item d-flex justify-content-between align-items-start" 
                      data-bs-toggle="offcanvas" data-bs-target="#{{strtolower(explode(" ", $t->tipo)[0])}}-{{$c->id}}" aria-controls="offcanvasBottom">
                      <div class="ms-2 me-auto destacadosText">
                        <div class="fw-bold">{{$c->titulo}}</div>
                        {{$c->comunicado}}

                        
                        
                      </div>
                      <span class="badge bg-primary rounded-pill" style="background-color: {{$config->color_principal}} !important">
                        
                        {{ $c->fecha_inicio }}
                      </span>
                    </li> 

                    <div class="offcanvas offcanvas-start" style="margin-top: 70px"  id="{{strtolower(explode(" ", $t->tipo)[0])}}-{{$c->id}}" aria-labelledby="offcanvas" >
                      <div class="offcanvas-header" style="color: #fff">
                        <h5 class="offcanvas-title" id="offcanvas">{{$t->tipo}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" ></button>
                      </div>
                      <div class="offcanvas-body">
                        <div class="row">
                          <div class="col-md-12 col-sm-12">
                            <h3>{{$c->titulo}}</h3>
                            <span> {{$c->comunicado}}</span>
                            <?php 
                                date_default_timezone_set('Europe/Madrid'); setlocale(LC_TIME, 'es_ES.UTF-8'); 
                                $fecha_i = \carbon\Carbon::createFromFormat('d/m/Y', $c->fecha_inicio);
                                $fecha_t = \carbon\Carbon::createFromFormat('d/m/Y', $c->fecha_termino);
                            ?>
                            <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text={{$c->titulo}}&details={{$c->comunicado}}&dates={{$fecha_i->format('Ymd') }}T{{$c->hora_inicio}}00/{{$fecha_t->format('Ymd') }}T{{$c->hora_termino}}00&location={{$c->direccion}}&sprop=name:{{$muni->nombre}}">
                              <div class="card" style="margin-top: 10px; margin-bottom: 10px">
                                <div class="card-body">
                                  <h5>Información</h5>
                                  <h6>
                                    <i class="bi bi-calendar4-week iconoDetalle"></i>
                                    Fecha:
                                    
                                    <small class="text-body-secondary" style="display: inline-flex">
                                      @if ($c->fecha_inicio == $c->fecha_termino)
                                      
                                          {{ \Carbon\Carbon::parse($fecha_i)->formatLocalized('%d de %B del %Y') }} 
                                      @else
                                      
                                      Desde el {{ \Carbon\Carbon::parse($fecha_i)->formatLocalized('%d de %B del %Y') }} <br>
                                      Hasta el {{ \Carbon\Carbon::parse($fecha_t)->formatLocalized('%d de %B del %Y') }} 
                                          
                                      @endif
                                    </small>
                                  </h6>

                                  <h6>
                                    <i class="bi bi-clock iconoDetalle"></i>
                                    Hora:
                                    
                                    <small class="text-body-secondary" style="display: inline-flex">
                                      @if ($c->hora_termino == null || $c->hora_inicio == $c->hora_termino)
                                        A las {{ $c->hora_inicio }} 
                                      @else
                                      
                                      Desde las {{ $c->hora_inicio }} <br>
                                      Hasta las {{ $c->hora_termino }} 
                                          
                                      @endif
                                    </small>

                                    <h6>
                                      <i class="bi bi-pin-map iconoDetalle"></i>
                                      Lugar:
                                      
                                      <small class="text-body-secondary" style="display: inline-flex">
                                        @if ($c->direccion == null || $c->direccion == "")
                                          No especificado 
                                        @else
                                        {{$c->direccion}}
                                            
                                        @endif
                                      </small>
                                  </h6>
                                </div>
                              </div>
                            </a>
                            

                          </div>
                        </div>
                        <div class="row" >
                          <div class="col-md-12 col-sm-12 align-self-end calendarioCustom">
                            <x-calendarEventComponent :fechaInicio='$c->fecha_inicio' :fechaTermino='$c->fecha_termino'></x-calendarEventComponent>
                          </div>
                        </div>
                        
                      </div>
                    </div>
                  @endforeach
                   
                  </ol>
            </p>
          </div>
        </div>
        @endif
          
        @endforeach


      </div>

    </div>
  </section>