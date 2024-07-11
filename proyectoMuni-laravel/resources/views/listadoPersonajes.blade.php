@extends('templates.principal-template')

@section('contenido')
<section id="breadcrumbs" class="breadcrumbs">
  <div class="container">

    <ol>
      <li><a href="/">Inicio</a></li>
      <li><a href="/personajes">Personajes Históricos</a></li>
    </ol>
    <h2> Personajes históricos </h2>

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
              @foreach ($personajes as $p)
              <div class="col-lg-4 col-md-6 align-items-stretch">
                <a href="/personajesHistoricos/{{$p->slug}}">
                  <div class="member">
                    <img src="{{ Storage::disk('gcs')->url($p->foto_perfil)}}" alt="">
                    <h4>{{$p->nombre}}</h4>
                    <span>{{$p->titulo}}</span>
                  </div>
                </a>
              </div>
              @endforeach
            </div>
            
          </div>
        </section>
      </div>
      <!-- End blog entries list -->

      <div class="col-lg-4">
        <x-sidebarComplete tipo="comuna"></x-sidebarComplete>
      </div>
      <!-- End blog sidebar -->

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