@extends('templates.principal-template')

@section('contenido')
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

        <ol>
            <li><a href="/">Inicio</a></li>
        </ol>
        <h2>Autoridades</h2>

        </div>
    </section><!-- End Breadcrumbs -->  
    
    
        <!-- ======= Team Section ======= -->
        <section id="team" class="team">
            <div class="container">

                <div class="row">
                    @foreach ($autoridades as $a)
                    <div 
                          @if ($a->index == 1)
                            class="col-lg-12 col-md-12 align-items-stretch"
                          @else
                            class="col-lg-4 col-md-6 align-items-stretch"
                          @endif>
                          <div class="member">
                              <a href="/autoridad/{{$a->slug}}">
                                  <img src="{{ Storage::disk('gcs')->url($a->imagen_perfil) }}" alt="{{$a->nombre}}" class="img-fluid">
                                  <h4>{{$a->nombre}}</h4>
                                  <span>{{$a->tipo_autoridad}}</span>
                              </a>
                              <!-- 
                                <div class="social">
                                  <a href=""><i class="bi bi-twitter"></i></a>
                                  <a href=""><i class="bi bi-facebook"></i></a>
                                  <a href=""><i class="bi bi-instagram"></i></a>
                                  <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                              -->
                            </div>
                    </div>
                        
                    @endforeach
                </div>

            </div>
          </section>
          <!-- End Team Section -->

@endsection

@section('js')
    <script>
      var option = document.querySelector("#menu_autoridades")
      option.classList.add("active")
    </script>
@endsection
