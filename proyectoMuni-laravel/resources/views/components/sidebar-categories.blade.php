@if ($tipo == "autoridad")
    <h3 class="sidebar-title">Autoridades</h3>
    <div class="sidebar-item categories">
        <ul>
            @foreach ($tipoAutoridades as $ta)
            <li><a href="/tipo-autoridad/{{$ta->slug}}">{{$ta->nombre}}</a></li>
            @endforeach
        </ul>
    </div>
    <h3 class="sidebar-title">Consejo Municipal</h3>
    <div class="sidebar-item categories">
        <ul>
            @foreach ($concejales as $c)
            <li><a href="/direccion/{{$c->slug}}">{{$c->nombre}}</a></li>
            @endforeach
        </ul>
    </div>
    <h3 class="sidebar-title">Direcciones Municipales</h3>
    <div class="sidebar-item categories">
        <ul>
            @foreach ($direcciones as $d)
            <li><a href="/direccion/{{$d->slug}}">{{$d->nombre}}</a></li>
            @endforeach
        </ul>
    </div>

@elseif ($tipo == "direccion")
    @if(count($tramites) > 0)
        <h3 class="sidebar-title">Trámites</h3>
        <div class="sidebar-item categories">
            <ul>
                @foreach ($tramites as $t)
                <li><a href="/tramites/{{$t->slug}}">{{$t->nombre}}</a></li>
                @endforeach
            </ul>
        </div>

    @endif
    
    <h3 class="sidebar-title">Direcciones Municipales</h3>
    <div class="sidebar-item categories">
        <ul>
            @foreach ($direcciones as $d)
            <li><a href="/direccion/{{$d->slug}}">{{$d->nombre}}</a></li>
            @endforeach
        </ul>
    </div>
    
@elseIf($tipo == "emprendimiento")

    <h3 class="sidebar-title">Categorias de Emprendimientos</h3>
    <div class="sidebar-item categories">
        <ul>
            @foreach ($categoriasEmprendimiento as $ca)
            <li><a href="/emprendedores/{{$ca->slug}}">{{$ca->nombre}}</a></li>    
            @endforeach
            
            <li><a href="#">Turismo</a></li>
            <li><a href="#">Gastronomía</a></li>
            <li><a href="#">Vestimenta</a></li>
            <li><a href="#">Regalos</a></li>
            <li><a href="#">Profesionales</a></li>
            <li><a href="#">Servicios</a></li>
        </ul>
    </div>
@elseIf($tipo == "personajes")

    <h3 class="sidebar-title">Conoce otros personajes históricos</h3>
    <div class="sidebar-item categories">
        <ul>
            @foreach ($personajes as $p)
            <li><a href="/personajesHistoricos/{{$p->slug}}">{{$p->nombre}}</a></li>
            @endforeach
        </ul>
    </div>
    <h3 class="sidebar-title">Nuestra Comuna</h3>
    <div class="sidebar-item categories">
        <ul>
            @foreach ($paginas as $p)
            <li><a href="/paginas/{{$p->slug}}">{{$p->titulo_menu}}</a></li>
            @endforeach
        </ul>
    </div>
@else

    <h3 class="sidebar-title">Nuestra Comuna</h3>
    <div class="sidebar-item categories">
        <ul>
            @foreach ($paginas as $p)
            <li><a href="/paginas/{{$p->slug}}">{{$p->titulo_menu}}</a></li>
            @endforeach
            <li><a href="/listadoPersonajes">Personajes Históricos</a></li>
            <li><a href="#">Complejos municipales</a></li>
        </ul>
    </div>

@endIf