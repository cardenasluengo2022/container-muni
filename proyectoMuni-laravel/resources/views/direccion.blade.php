@extends('templates.principal-template')
@section('css')
<style>
  .contact{
    list-style: none;
  }
  .contact li i{
    margin-left: -30px;
    margin-right: 5px;
  }
</style>
    
@endsection

@section('contenido')
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

        <ol>
            <li><a href="/">Inicio</a></li>
            <li><a href="/direcciones">Direcciones Municipales</a></li>
        </ol>
        <h2>{{$direccion->nombre}}</h2>

        </div>
    </section><!-- End Breadcrumbs -->  

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 entries">

            <article class="entry entry-single">

              <div class="entry-img">
                <img src="{{ Storage::disk('gcs')->url($direccion->imagen_portada)}}" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a href="/direccion/{{$direccion->slug}}">{{$direccion->titulo}}</a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i> 
                    <a href="#">
                      <time datetime="2020-01-01">
                        <?php date_default_timezone_set('Europe/Madrid'); setlocale(LC_TIME, 'es_ES.UTF-8'); ?>
                          {{ \Carbon\Carbon::parse($direccion->created_at)->formatLocalized('%d de %B del %Y') }} 
                          a las {{ \Carbon\Carbon::parse($direccion->created_at)->formatLocalized('%H:%M') }}
                      </time>
                  </a>
                </li>
                </ul>
              </div>

              <div class="entry-content">
                {!! $direccion->texto !!}
              </div>

            </article><!-- Fin Direccion -->

            <!-- Contacto -->
            <div class="blog-author d-flex align-items-center">
              <img src="{{ Storage::disk('gcs')->url($direccion->imagen_perfil)}}" class="rounded-circle float-left" alt="">
              <div>
                <h4>Director: {{$direccion->director}}</h4>
                <div class="social-links">
                  <ul class="contact">
                    <li> <i class="bi bi-telephone-fill"></i>  {{$direccion->fono}} </li>
                    <li><i class="bi bi-envelope-at-fill"></i>  {{$direccion->email}}</li>
                    <li><i class="bi bi-pin-map-fill"></i>  {{$direccion->direccion}}</li>
                    <li><i class="bi bi-calendar-week-fill"></i>  {{$direccion->horario}}</li>
                  </ul>
                </div>
                <p>
                </p>
              </div>
            </div>


            
            @if ($direccion->subdirecciones_count > 0)

            <article class="entry entry-single">
              <h4 class="comments-count">Departamentos y Oficinas</h4>
              @foreach ($tipo_subdirecciones as $ts)
                  @continue(count($ts->subDirecciones) <= 0)
                  @foreach ($ts->subDirecciones as $sd)  
                    <div class="blog-author d-flex align-items-center">
                      <div>
                        <h4>{{$sd->nombre}}</h4>
                        <div class="social-links">
                          <ul class="contact">
                            <li> <i class="bi bi-telephone-fill"></i>  {{$sd->fono}} </li>
                            <li><i class="bi bi-envelope-at-fill"></i>  {{$sd->email}}</li>
                            <li><i class="bi bi-pin-map-fill"></i>  {{$sd->direccion}}</li>
                            <li><i class="bi bi-calendar-week-fill"></i>  {{$sd->horario}}</li>
                          </ul>
                        </div>
                        <p>
                        </p>
                      </div>
                    </div>
                  @endforeach
              @endforeach
            </article>

            @endif

          </div><!-- Fin Departamentos -->

          <div class="col-lg-4">

            <x-sidebarComplete tipo="direccion" direccion="{{$direccion->id}}"></x-sidebarComplete>
          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Single Section -->
    


@endsection

@section('js')
<script>
    var option = document.querySelector("#menu_autoridades")
    option.classList.add("active")
</script>    
@endsection