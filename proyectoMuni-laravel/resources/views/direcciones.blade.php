@extends('templates.principal-template')

@section('contenido')
<section id="breadcrumbs" class="breadcrumbs">
  <div class="container">

    <ol>
      <li><a href="/">Inicio</a></li>
    </ol>
    <h2> Direcciones Municipales </h2>

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
              @foreach ($direcciones as $d)
              <div class="col-lg-4 col-md-6 align-items-stretch">
                <a href="/direccion/{{$d->slug}}">
                  <div class="member">
                    <img src="{{asset('storage/'.$d->imagen_perfil)}}" alt="">
                    <h4>{{$d->nombre}}</h4>
                    <span>{{$d->director}}</span>
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
        <x-sidebarComplete tipo="autoridad"></x-sidebarComplete>
      </div>
      <!-- End blog sidebar -->

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