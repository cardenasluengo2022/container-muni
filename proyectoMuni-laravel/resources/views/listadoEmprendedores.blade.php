@extends('templates.principal-template')

@section('contenido')
<section id="breadcrumbs" class="breadcrumbs">
  <div class="container">

    <ol>
      <li><a href="/">Inicio</a></li>
      <li><a href="/categoriaEmprendedores">Chillanejos Emprendedores</a></li>
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
              <div class="col-lg-4 col-md-6 align-items-stretch">
                <a href="/emprendimiento">
                  <div class="member">
                    <img src="{{asset('img/muni/naya.jpeg')}}" alt="">
                    <h4>Artesana Nayadet Nuñez</h4>
                    <span>Artesanía en Greda</span>
                    <div class="social">
                      <a href="https://www.facebook.com/nayadetdeQuinchamali"><i class="bi bi-facebook"></i></a>
                      <a href="https://www.instagram.com/artenegroquinchamali/"><i class="bi bi-instagram"></i></a>
                    </div>
                  </div>
                  
                  
                </a>
              </div>

              <div class="col-lg-4 col-md-6 align-items-stretch">
                <div class="member">
                  <img src="{{asset('img/muni/madera.png')}}" alt="">
                  <h4>Arrayán Artesanía</h4>
                  <span>Artesanías en madera nativa</span>
                  <div class="social">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                  </div>
                </div>
                
              </div>

              <div class="col-lg-4 col-md-6 align-items-stretch">
                <div class="member">
                  <img src="{{asset('img/muni/fusion.png')}}" alt="">
                  <h4>ArteFusión Quinchamalí</h4>
                  <span>Alfareras de Quinchamalí.</span>
                  <div class="social">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/artefusion_quinchamali/"><i class="bi bi-instagram"></i></a>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </section>
      </div>
      <!-- End blog entries list -->

      <div class="col-lg-4">

        <x-sidebarComplete tipo="emprendimiento"></x-sidebarComplete>

      </div>
      <!-- End blog sidebar -->

    </div>

  </div>
</section><!-- End Blog Single Section -->



@endsection

@section('js')
<script>
    var option = document.querySelector("#menu_emprendedores")
    option.classList.add("active")
</script>    
@endsection