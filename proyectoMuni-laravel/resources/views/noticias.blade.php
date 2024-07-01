@extends('templates.principal-template')

@section('contenido')
<section id="breadcrumbs" class="breadcrumbs">
  <div class="container">

    <ol>
      <li><a href="/">Inicio</a></li>
      <!-- <li><a href="/noticias">Noticias</a></li> -->
    </ol>
    <h2> Noticias </h2>

  </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Blog Single Section ======= -->
<section id="blog" class="blog">
  <div class="container" data-aos="fade-up">

    <div class="row">
      <div class="col-lg-8 entries">

          @foreach ($listaNoticias as $noticia)
          <article class="entry">

            <div class="entry-img">
              <?php $images = json_decode($noticia->imagen); ?>
              <img src="{{asset('storage/'.$images[0])}}" alt="" class="img-fluid">
            </div>

            <h2 class="entry-title">
              <a href="/noticias/{{$noticia->slug}}">{{$noticia->titular}}</a>
            </h2>

            <div class="entry-meta">
              <ul>
                <!--
                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="#">{{$noticia->perfil}}</a></li>

                -->
                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> 
                  <a href="/noticias/{{$noticia->slug}}">
                    <time datetime="2020-01-01">
                    <?php date_default_timezone_set('Europe/Madrid'); setlocale(LC_TIME, 'es_ES.UTF-8'); ?>
                    {{ \Carbon\Carbon::parse($noticia->created_at)->formatLocalized('%d de %B del %Y') }} 
                    a las {{ \Carbon\Carbon::parse($noticia->created_at)->formatLocalized('%H:%M') }}
                    </time>
                  </a>
                </li>
                <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="/noticias/{{$noticia->slug}}">12 Comments</a></li>
              </ul>
            </div>

            <div class="entry-content">
              <p>
                {!! Str::of($noticia->redaccion)->words(50) !!}
              </p>
              <div class="read-more">
                <a href="/noticias/{{$noticia->slug}}">Leer más</a>
              </div>
            </div>

          </article><!-- End blog entry -->
          @endforeach

          <div class="blog-pagination">
            <ul class="justify-content-center">
              <li><a href="#">1</a></li>
              <li class="active"><a href="#">2</a></li>
              <li><a href="#">3</a></li>
            </ul>
          </div>

      </div><!-- End blog entries list -->
      
      <!-- End blog entries list -->

      <div class="col-lg-4">

       <x-sidebarComplete tipo="noticia"></x-sidebarComplete>

      </div>
      <!-- End blog sidebar -->

    </div>

  </div>
</section><!-- End Blog Single Section -->



@endsection

@section('js')
    <script>
      var option = document.querySelector("#menu_noticias")
      option.classList.add("active")
    </script>
@endsection