@extends('templates.principal-template')

@section('contenido')
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

        <ol>
            <li><a href="/">Inicio</a></li>
            <li>Chillanejos Emprendedores</li>
        </ol>
        <h2>Categorías de Emprendimientos</h2>

        </div>
    </section><!-- End Breadcrumbs -->  
    
    
        <!-- ======= Team Section ======= -->
        <section id="team" class="team">
            <div class="container">
              <div class="row">
                @foreach ($categorias as $c)
                    <div class="col-lg-4 col-md-6 align-items-stretch">
                      <a href="/emprendedores/{{$c->slug}}">
                        <div class="member">
                          <img src="{{asset('storage/'.$c->imagen)}}" alt="">
                          <h4>{{$c->titulo}}</h4>
                          <span>{{$c->subtitulo}}</span>
                        </div>
                      </a>
                    </div>
                 
                @endforeach
              </div>
      
            </div>
          </section>
          <!-- End Team Section -->

@endsection
@section('js')
<script>
    var option = document.querySelector("#menu_emprendedores")
    option.classList.add("active")
</script>    
@endsection
