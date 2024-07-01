@extends('templates.principal-template')

@section('contenido')
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

        <ol>
            <li><a href="/">Inicio</a></li>
            <li><a href="/autoridades">Autoridades</a></li>
            <li>{{$tipoAutoridad->nombre}}</li>
        </ol>
        <h2>{{$autoridad->nombre}}</h2>

        </div>
    </section><!-- End Breadcrumbs -->  

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 entries">

            <article class="entry entry-single">

              <div class="entry-img">
                <img src="{{asset('storage/'.$autoridad->imagen_portada)}}" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a href="/autoridad/{{$autoridad->slug}}">{{$autoridad->titulo_redaccion}}</a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i> 
                    <a href="#">
                      <time datetime="2020-01-01">
                        <?php date_default_timezone_set('Europe/Madrid'); setlocale(LC_TIME, 'es_ES.UTF-8'); ?>
                          {{ \Carbon\Carbon::parse($autoridad->created_at)->formatLocalized('%d de %B del %Y') }} 
                          a las {{ \Carbon\Carbon::parse($autoridad->created_at)->formatLocalized('%H:%M') }}
                      </time>
                  </a>
                </li>
                </ul>
              </div>

              <div class="entry-content">
                {!! $autoridad->redaccion !!}
              </div>

            </article><!-- End blog entry -->

          </div><!-- End blog entries list -->

          <div class="col-lg-4">

            <x-sidebarComplete tipo="autoridad"></x-sidebarComplete>
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

