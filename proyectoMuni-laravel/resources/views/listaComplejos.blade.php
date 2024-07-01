@extends('templates.principal-template')

@section('contenido')
<section id="breadcrumbs" class="breadcrumbs">
  <div class="container">

    <ol>
      <li><a href="/">Inicio</a></li>
      <li><a href="/categoriasComplejos">Complejos Municipales</a></li>
    </ol>
    <h2> {{$categoria->titulo}} </h2>

  </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Blog Single Section ======= -->
<section id="blog" class="blog">
  <div class="container" data-aos="fade-up">

    <div class="row">

      <div class="col-lg-8 entries">
        <section id="team" class="team">
          <div class="container">
            <div class="row">
              @if ($complejos != null && count($complejos) > 0)
                @foreach ($complejos as $c)
                <div class="col-lg-4 col-md-6 align-items-stretch">
                  <a href="/complejo/{{$c->slug}}">
                    <div class="member">
                      <?php $images = json_decode($c->imagen_principal); ?>
                        <img src="{{asset('storage/'.$images[0])}}" alt="">
                      <h4>{{$c->nombre}}</h4>
                      <span>{{$c->titulo}}</span>
                    </div>
                  </a>
                </div>
                @endforeach
              @else
                  <h4>Lo sentimos, no se han encontrado regristros.</h4>
              @endif
            </div>
          </div>
        </section>
      </div>
      <!-- End blog entries list -->

      <div class="col-lg-4">

        <x-sidebarComplete tipo="comuna"></x-sidebarComplete>
      </div><!-- End blog sidebar -->

    </div>

  </div>
</section><!-- End Blog Single Section -->



@endsection

@section('js')
<script>
    var option = document.querySelector("#menu_comuna")
    option.classList.add("active")
</script>    
@endsection