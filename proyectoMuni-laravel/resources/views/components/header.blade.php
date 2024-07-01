<div class="container d-flex justify-content-between align-items-center">

    <div class="logo">
      <h1><a href="/">{{$muni->nombre}}</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
    </div>

    <nav id="navbar" class="navbar">
      <ul class="lista">
        <li><a href="/" id="menu_inicio">Inicio</a></li>
        <li class="dropdown"><a href="#" id="menu_comuna"><span>Nuestra Comuna</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            @foreach ($paginas as $p)
            <li><a href="/paginas/{{$p->slug}}">{{$p->titulo_menu}}</a></li>
            @endforeach
            <li class="dropdown"><a href="/personajesHistoricos"><span>Personajes históricos</span> <i class="bi bi-chevron-right"></i></a>
              <ul>
                @foreach ($personajes as $personaje)
                <li><a href="/personajesHistoricos/{{$personaje->slug}}">{{$personaje->nombre}}</a></li>
                @endforeach
              </ul>
            </li>
            <li><a href="/categoriasComplejos">Complejos municipales</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="/autoridades" id="menu_autoridades"><span>Autoridades</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            @foreach ($tipos_autoridades as $ta)
              <li><a href="/tipo-autoridad/{{$ta->slug}}">{{$ta->nombre}}</a></li>
            @endforeach
            
            @if (count($direcciones) > 0)
            <li class="dropdown"><a href="/direcciones"><span>Direcciones</span> <i class="bi bi-chevron-right"></i></a>
              <ul>
                @foreach ($direcciones as $dir)
                <li><a href="/direccion/{{$dir->slug}}">{{$dir->nombre}}</a></li>
                @endforeach
              </ul>
            </li>
            @endif
            <li><a href="/concejales">Consejo Municipal</a></li>
          </ul>
        </li>

        <li><a href="/noticias" id="menu_noticias">Noticias</a></li>
        <li><a href="/categoriasEmprendedores" id="menu_emprendedores">Chillanejos emprendedores</a></li>
        <li><a href="/" id="menu_contacto">Contáctanos</a></li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

  </div>