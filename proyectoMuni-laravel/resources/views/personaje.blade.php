@extends('templates.principal-template')

@section('css')
@endsection

@section('contenido')
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <ol>
            <li><a href="/">Inicio</a></li>
            <li><a href="/personajesHistoricos">Personajes Históricos</a></li>
        </ol>
        <h2>{{$personaje->nombre}} </h2>

    </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Blog Single Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

        <div class="row">

            <div class="col-lg-8 entries">

                <article class="entry entry-single">

                    <div class="entry-img">
                        <?php $images = json_decode($personaje->imagenes); ?>
                        <img src="{{ Storage::disk('gcs')->url($images[0])}}" alt="" class="img-fluid">
                    </div>

                    <h2 class="entry-title">
                        <a href="/personajesHistoricos/{{$personaje->slug}}">{{$personaje->titulo}}</a>
                    </h2>

                    <div class="entry-meta">
                        <ul>
                            <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="#">{{$personaje->autor}}</a></li>
                            <li class="d-flex align-items-center"><i class="bi bi-clock"></i> 
                              <a href="blog-single.html">
                                <time datetime="2020-01-01">
                                  <?php date_default_timezone_set('Europe/Madrid'); setlocale(LC_TIME, 'es_ES.UTF-8'); ?>
                                    {{ \Carbon\Carbon::parse($personaje->created_at)->formatLocalized('%d de %B del %Y') }} 
                                    a las {{ \Carbon\Carbon::parse($personaje->created_at)->formatLocalized('%H:%M') }}
                                </time>
                              </a>
                            </li>
                        </ul>
                    </div>

                    <div class="entry-content">
                      {!! $personaje->texto !!}
                    </div>
                    <div class="entry-content" id="video">
                      {!! $personaje->video !!}
                    </div>

                </article><!-- End blog entry -->

            </div><!-- End blog entries list -->

            <div class="col-lg-4">
              <x-sidebarComplete tipo="personajes"></x-sidebarComplete>
            </div>

        </div>

    </div>
</section><!-- End Blog Single Section -->



@endsection

@section('js')
<script>
    var option = document.querySelector("#menu_comuna");
    option.classList.add("active");
</script>    
@endsection
