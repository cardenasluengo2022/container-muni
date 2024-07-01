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
            <li><a href="/categoriasComplejos">Complejos Municipales</a></li>
            <li><a href="/complejos/{{$categoria->slug}}">{{$categoria->titulo}}</a></li>
        </ol>
        <h2>{{$complejo->nombre}} </h2>
    </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Blog Single Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-8 entries">
                <article class="entry entry-single">
                    <div class="entry-img">
                        <?php $images = json_decode($complejo->imagenes); ?>
                        <img src="{{asset('storage/'.$images[0])}}" alt="" class="img-fluid">
                    </div>
                    <h2 class="entry-title">
                      <a href="#"> {{$complejo->titulo}}<br /> </a>
                    </h2>
                    <div class="entry-meta">
                      <ul>
                          <li class="d-flex align-items-center"><i class="bi bi-clock"></i> 
                            <a href="/complejo/{{$complejo->slug}}">
                              <time datetime="2020-01-01">
                                <?php date_default_timezone_set('Europe/Madrid'); setlocale(LC_TIME, 'es_ES.UTF-8'); ?>
                                  {{ \Carbon\Carbon::parse($complejo->created_at)->formatLocalized('%d de %B del %Y') }} 
                                  a las {{ \Carbon\Carbon::parse($complejo->created_at)->formatLocalized('%H:%M') }}
                              </time>
                            </a>
                          </li>
                      </ul>
                  </div>
                  <div class="entry-content">
                  {!! $complejo->texto !!}
                  </div>
                </article>
                <!-- Contacto -->
                <div class="blog-author d-flex align-items-center">
                  <?php $images = json_decode($complejo->imagen_principal); ?>
                  <img src="{{asset('storage/'.$images[0])}}" class="rounded-circle float-left" alt="">
                  <div>
                    <h4>Contacto:</h4>
                    <div class="social-links">
                      <ul class="contact">
                        <li> <i class="bi bi-telephone-fill"></i> {{$complejo->fono}} </li>
                        <li><i class="bi bi-envelope-at-fill"></i>{{$complejo->email}}</li>
                        <li><i class="bi bi-pin-map-fill"></i>{{$complejo->direccion}}</li>
                        <li><i class="bi bi-calendar-week-fill"></i>{{$complejo->horario}}</li>
                      </ul>
                    </div>
                    <p>
                    </p>
                  </div>
                </div>
            </div>
            <div class="col-lg-4">
              <x-sidebarComplete tipo="complejos"></x-sidebarComplete>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script>
    var option = document.querySelector("#menu_comuna")
    option.classList.add("active")
</script>    
@endsection
