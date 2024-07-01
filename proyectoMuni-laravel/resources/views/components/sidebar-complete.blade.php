<div class="sidebar">

    <h3 class="sidebar-title">Buscar</h3>
    <div class="sidebar-item search-form">
      <form action="">
        <input type="text">
        <button type="submit"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End sidebar search formn-->

    <x-sidebarCategories :tipo="$tipo"></x-sidebar-sidebarCategories>
    <!-- End sidebar categories-->

    <h3 class="sidebar-title">Noticias Recientes </h3>
    <div class="sidebar-item recent-posts">
      <div class="post-item clearfix">
        <img src="{{asset('img/muni/alcalde.jpg')}}" alt="">
        <h4><a href="blog-single.html">Estamos trabajando en la reparación integral del estadio, no solo la
            cancha</a></h4>
        <time datetime="2020-01-01">2 de Marzo, 2023</time>
      </div>

      <div class="post-item clearfix">
        <img src="{{asset('img/muni/alcalde4.jpg')}}" alt="">
        <h4><a href="blog-single.html">El informe cuestiona lo que la ley sí permite hacer</a></h4>
        <time datetime="2020-01-01">Jan 1, 2020</time>
      </div>

      <!-- 
          <div class="post-item clearfix">
            <img src="assets/img/blog/blog-recent-3.jpg" alt="">
            <h4><a href="blog-single.html">Id quia et et ut maxime similique occaecati ut</a></h4>
            <time datetime="2020-01-01">Jan 1, 2020</time>
          </div>

          <div class="post-item clearfix">
            <img src="assets/img/blog/blog-recent-4.jpg" alt="">
            <h4><a href="blog-single.html">Laborum corporis quo dara net para</a></h4>
            <time datetime="2020-01-01">Jan 1, 2020</time>
          </div>

          <div class="post-item clearfix">
            <img src="assets/img/blog/blog-recent-5.jpg" alt="">
            <h4><a href="blog-single.html">Et dolores corrupti quae illo quod dolor</a></h4>
            <time datetime="2020-01-01">Jan 1, 2020</time>
          </div>
          -->

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