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
            <li><a href="/direccion/{{$direccion->slug}}">{{$direccion->nombre}}</a></li>
        </ol>
        <h2>{{$tramite->nombre}}</h2>

        </div>
    </section><!-- End Breadcrumbs -->  

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 entries">

            <article class="entry entry-single">
              
              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i> 
                    <a href="#">
                      <time datetime="2020-01-01"> Información actualizada el 
                        <?php date_default_timezone_set('Europe/Madrid'); setlocale(LC_TIME, 'es_ES.UTF-8'); ?>
                        @if($tramite->updated_at != null)
                        {{ \Carbon\Carbon::parse($tramite->updated_at)->formatLocalized('%d de %B del %Y') }} 
                        a las {{ \Carbon\Carbon::parse($tramite->updated_at)->formatLocalized('%H:%M') }}
                        @else
                        {{ \Carbon\Carbon::parse($tramite->created_at)->formatLocalized('%d de %B del %Y') }} 
                          a las {{ \Carbon\Carbon::parse($tramite->created_at)->formatLocalized('%H:%M') }}
                        @endif
                          
                      </time>
                  </a>
                </li>
                </ul>
              </div>

              <div class="entry-content">
                {!! $tramite->descripcion !!}
              </div>

            </article><!-- Fin Direccion -->
            <article class="entry entry-single">
              <h3>Descarga de Archivos y formularios</h3>
              <div class="entry-content">

              </div>
            </article>


          </div><!-- Fin Departamentos -->

          <div class="col-lg-4">

            <x-sidebarComplete tipo="direccion" direccion="{{$direccion->id}}"></x-sidebarComplete>

            <div class="sidebar">          
              <h3 class="sidebar-title">Archivos </h3>
              <div class="sidebar-item recent-posts">
                <div class="post-item clearfix">
                  <h4><a href="blog-single.html">Estamos trabajando en la reparación integral del estadio, no solo la
                      cancha</a></h4>
                </div>
              </div><!-- End sidebar recent posts-->
            </div><!-- End sidebar -->


          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Single Section -->
    


@endsection

