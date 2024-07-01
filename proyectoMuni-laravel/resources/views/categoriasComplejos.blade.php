@extends('templates.principal-template')

@section('contenido')
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

        <ol>
            <li><a href="/">Inicio</a></li>
            <li>Complejos Municipales</li>
        </ol>
        <h2>Categorías de Complejos e instalaciones</h2>

        </div>
    </section><!-- End Breadcrumbs -->  
    
    
        <!-- ======= Team Section ======= -->
        <section id="team" class="team">
            <div class="container">
              <div class="row">
                
                @if (count($categorias) > 0)
                @foreach ($categorias as $c)
                <div class="col-lg-4 col-md-6 align-items-stretch">
                  <a href="/complejos/{{$c->slug}}">
                    <div class="member">
                      <img src="{{asset('storage/'.$c->imagen)}}" alt="">
                      <h4>{{$c->titulo}}</h4>
                      <span>{{$c->descripcion}}</span>
                    </div>
                  </a>
                </div>
                @endforeach
                @else
                <h4>Lo sentimos, no se han encontrado registros.</h4>
                @endif

                
                
            </div>
          </section>
          <!-- End Team Section -->

@endsection

@section('js')
<script>
    var option = document.querySelector("#menu_comuna")
    option.classList.add("active")
</script>    
@endsection