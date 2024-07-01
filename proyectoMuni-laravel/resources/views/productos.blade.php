@extends('templates.principal-template')

@section('contenido')
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

          <ol>
            <li><a href="/">Inicio</a></li>
            <li><a href="/categoriaEmprendedores">Chillanejos Emprendedores</a></li>
            <li><a href="/listadoEmprendimientos">Artesanos</a></li>
            <li><a href="/emprendimiento">Nayadet Nuñez - Artesana de Quinchamalí </a></li>
        </ol>
        <h2>Catálogo de Productos</h2>

        </div>
    </section><!-- End Breadcrumbs -->  
    
    
        <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="row">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">Todos</li>
              <li data-filter=".filter-tradicional">Tradicional</li>
              <li data-filter=".filter-taller">Talleres</li>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container">

          <div class="col-lg-4 col-md-6 portfolio-item filter-tradicional">
            <div class="portfolio-wrap">
              <img src="{{asset('img/muni/p6.png')}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Jarrón de greda.</h4>
                <p>40 cm de alto, realizado con la técnica Tradicional de Quinchamali.</p>
                <div class="portfolio-links">
                  <a href="https://www.instagram.com/p/CoEAz_uuZ03/" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-tradicional">
            <div class="portfolio-wrap">
              <img src="{{asset('img/muni/p5.png')}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Lámpara</h4>
                <p>Fabricada con la técnica Tradicional de Quinchamali.</p>
                <div class="portfolio-links">
                  <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 portfolio-item filter-tradicional">
            <div class="portfolio-wrap">
              <img src="{{asset('img/muni/p3.png')}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Guitarrera</h4>
                <p>Diseños bajo relieve. Realizados con una aguja de vitrola</p>
                <div class="portfolio-links">
                  <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-taller">
            <div class="portfolio-wrap">
              <img src="{{asset('img/muni/p2.png')}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Taller</h4>
                <p>Enseñando las tecnicas de la alfarería</p>
                <div class="portfolio-links">
                  <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 portfolio-item filter-tradicional">
            <div class="portfolio-wrap">
              <img src="{{asset('img/muni/p4.png')}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Tetera</h4>
                <p>Alfarería de Quinchamalí, técnica Tradicional.</p>
                <div class="portfolio-links">
                  <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-taller">
            <div class="portfolio-wrap">
              <img src="{{asset('img/muni/p1.png')}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Aprendiendo</h4>
                <p>Absorviendo conocimientos</p>
                
                <div class="portfolio-links">
                  <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Section -->

@endsection

