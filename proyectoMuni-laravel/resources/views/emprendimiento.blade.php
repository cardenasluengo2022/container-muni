@extends('templates.principal-template')

@section('contenido')
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <ol>
            <li><a href="/">Inicio</a></li>
            <li><a href="/categoriaEmprendedores">Chillanejos Emprendedores</a></li>
            <li><a href="/listadoEmprendimientos">Artesanos</a></li>
        </ol>
        <h2>Nayadet Nuñez - Artesana de Quinchamalí </h2>

    </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Blog Single Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

        <div class="row">

            <div class="col-lg-8 entries">

                <article class="entry entry-single">

                    <div class="entry-img">
                        <img src="{{asset('img/muni/nayaPortada.png')}}" alt="" class="img-fluid">
                    </div>

                    <div class="entry-content">
                        <p>
                          Toda una vida, desde que tengo memoria que conozco la greda y que mi mamá, mi abuela, mi papá y mis hermanos trabajaban en greda. A mi mamá, su abuela le enseñó que tenía que seguir con la tradición o por lo menos aprenderla, y mi mamá hizo lo mismo con todos sus hijos. Nos enseñó a conocer la greda, porque no es solo armar la greda, sino que uno tiene que saber cómo reconocer la materia prima, que son varios pasos. Conocer la greda negra, es muy complicado porque hay varios tipos de greda. Hay una greda que viene con mucho carboncillo y eso al utilizarla y mezclar con la arena y arena amarilla, queda pasosa y cuando haces un mate y luego le echas algo caliente, te queda toda la mano manchada de negro, porque empieza a salir por los poros el carboncillo.
                        </p>
                    </div>

                    <h2 class="entry-title">
                      <a href="/productos">Galería de productos</a>
                  </h2>

                     
                    <div class="entry-footer">
                      <i class="bi bi-folder"></i>
                      <ul class="cats">
                        <li><a href="/listadoEmprendimientos">Artesanía</a></li>
                      </ul>

                      <i class="bi bi-tags"></i>
                      <ul class="tags">
                        <li><a href="#">Mujeres Power</a></li>
                        <li><a href="#">Alfarería</a></li>
                        <li><a href="#">Quinchamalí</a></li>
                      </ul>
                    </div>
                </article><!-- End blog entry -->


                
              
              <div class="blog-author d-flex align-items-center">
              <img src="{{asset('img/muni/naya.jpeg')}}" class="rounded-circle float-left" alt="">
              <div>
                <h4>Nayadet Nuñes</h4>
                <div class="social-links">
                  <a href="#"><i class="bi bi-whatsapp"></i>+56 9 12345678</a> <br/>
                  <a href="https://www.facebook.com/nayadetdeQuinchamali"><i class="bi bi-facebook"></i>nayadetdeQuinchamali</a><br/>
                  <a href="https://www.instagram.com/artenegroquinchamali/"><i class="bi bi-instagram"></i>artenegroquinchamali</a>
                </div>
                <p>
                </p>
              </div>
            </div>
              <!-- End blog author bio -->


                
              <div class="blog-comments">

              <h4 class="comments-count">2 Comentarios</h4>

              <div id="comment-1" class="comment">
                <div class="d-flex">
                  <div class="comment-img"><img src="assets/img/blog/comments-1.jpg" alt=""></div>
                  <div>
                    <h5><a href="">Andrea Rodriguez</a></h5>
                    <time datetime="2020-01-01">01 Enero, 2023</time>
                    <p>
                      Tu trabajo es maravilloso, he tenido la suerte de conocerte en persona y eres genial
                    </p>
                  </div>
                </div>
              </div>

              <div id="comment-2" class="comment">
                <div class="d-flex">
                  <div class="comment-img"><img src="assets/img/blog/comments-2.jpg" alt=""></div>
                  <div>
                    <h5><a href="">Aron Alvarado</a></h5>
                    <time datetime="2020-01-01">17 Diciembre, 2022</time>
                    <p>
                      Tuve la suerte de conocerte en mi ultimo viaje a la región de ñuble, haces un hermoso trabajo.
                    </p>
                  </div>
                </div>


              </div>



              <div class="reply-form">
                <h4>Deja tu Comentario</h4>
                <p><span>Tu comentario será recibido y sujeto a evaluación</span> </p>
                <form action="">
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <input name="name" type="text" class="form-control" placeholder="Nombre*">
                    </div>
                    <div class="col-md-6 form-group">
                      <input name="email" type="text" class="form-control" placeholder="Email*">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                      <textarea name="comment" class="form-control" placeholder="Comentario*"></textarea>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Enviar</button>

                </form>

              </div>

            </div>
              
              <!-- End blog comments -->

            </div><!-- End blog entries list -->

            <div class="col-lg-4">

                <div class="sidebar">

                    <h3 class="sidebar-title">Buscar</h3>
                    <div class="sidebar-item search-form">
                        <form action="">
                            <input type="text">
                            <button type="submit"><i class="bi bi-search"></i></button>
                        </form>
                    </div><!-- End sidebar search formn-->

                    <x-sidebarComplete tipo="emprendimiento"></x-sidebarComplete>
                    <!-- End sidebar categories-->

                    <h3 class="sidebar-title">Noticias Recientes </h3>
                    <div class="sidebar-item recent-posts">
                        <div class="post-item clearfix">
                            <img src="{{asset('img/muni/alcalde.jpg')}}" alt="">
                            <h4><a href="blog-single.html">Estamos trabajando en la reparación integral del estadio, no solo la cancha</a></h4>
                            <time datetime="2020-01-01">2 de Marzo, 2023</time>
                        </div>

                        <div class="post-item clearfix">
                            <img src="{{asset('img/muni/alcalde4.jpg')}}" alt="">
                            <h4><a href="blog-single.html">El informe cuestiona lo que la ley sí permite hacer</a></h4>
                            <time datetime="2020-01-01">Jan 1, 2020</time>
                        </div>


                    </div><!-- End sidebar recent posts-->

                    <h3 class="sidebar-title">Tags</h3>
                    <div class="sidebar-item tags">
                        <ul>
                            <li><a href="#">Alcalde</a></li>
                            <li><a href="#">Estadio</a></li>
                            <li><a href="#">Negocios</a></li>
                            <li><a href="#">Emprendimientos</a></li>
                            <li><a href="#">Administración</a></li>
                            <li><a href="#">Municipio</a></li>
                            <li><a href="#">Permisos</a></li>
                            <li><a href="#">Bono</a></li>
                            <li><a href="#">Tránsito</a></li>
                            <li><a href="#">Celebración</a></li>
                            <li><a href="#">Ayuda</a></li>
                        </ul>
                    </div><!-- End sidebar tags-->

                </div><!-- End sidebar -->

            </div><!-- End blog sidebar -->

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