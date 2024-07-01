<title>{{$muni->nombre}}</title>
<meta content="Sitio web informativo de la Municipalidad {{$muni->nombre}}" name="description">
<meta content="{{$muni->nombre}}" name="keywords">

@if (isset($config->icono) && $config->icono != null && $config->icono != "" )
<!-- Favicons -->
  <link href="{{ asset('storage/'.$config->icono) }}" rel="icon">
  <link href="{{ asset('storage/'.$config->icono) }}" rel="apple-touch-icon">

@endif
@if (isset($config->icono) && $config->icono != null && $config->icono != "" )
  <meta name="msapplication-TileImage" content="{{ asset('storage/'.$config->logo) }}">
@endif

@if (isset($config->fuente) && $config->fuente != null && $config->fuente != "" )
    @php
        $url = explode("/", $config->fuente);
        $fuente = explode(".", end($url));
    @endphp

    <style>
      @font-face {
        font-family: "{{$fuente[0]}}";
        src: url(" {{ asset('storage/'.$config->fuente )  }}");
      }

      body {
      font-family: "{{$fuente[0]}}";
      }
      h1,
      h2,
      h3,
      h4,
      h5,
      h6,
      #hero .btn-get-started,
      .counts .count-box p,
      #footer .footer-top .footer-info p {
        font-family: "{{$fuente[0]}}";
      }

      #header .logo h1,
      .navbar a,
      .navbar a:focus,
      .section-title h2,
      .counts .count-box a {
        font-family: "{{$fuente[0]}}";
      }

    </style>
@endif

@if (isset($config->color_principal) && $config->color_principal != null && $config->color_principal != "" )
  <meta name="msapplication-TileColor" content="{{$config->color_principal}}">
	<meta name="theme-color" content="{{$config->color_principal}}">
  <style>
      a, #topbar .contact-info i,
      #topbar .contact-info i a:hover,
      .navbar a:hover,
      .navbar .active,
      .navbar .active:focus,
      .navbar li:hover>a,
      .navbar .dropdown ul a:hover,
      .navbar .dropdown ul .active:hover,
      .navbar .dropdown ul li:hover>a,
      .navbar-mobile a:hover,
      .navbar-mobile .active,
      .navbar-mobile li:hover>a,
      .navbar-mobile .dropdown ul a:hover,
      .navbar-mobile .dropdown ul .active:hover,
      .navbar-mobile .dropdown ul li:hover>a,
      #hero h2 span,
      #hero .btn-get-started:hover,
      .featured .icon-box i,
      .about .content ul i,
      .services .icon-box:hover .icon i,
      .counts .count-box i,
      .skills .content ul i,
      .portfolio .portfolio-wrap .portfolio-links a:hover,
      .team .member .social a:hover,
      .contact .info-box i,
      .blog .entry .entry-title a:hover,
      .blog .entry .entry-footer a:hover,
      .blog .blog-comments .comment h5 a:hover,
      .blog .sidebar .categories ul a:hover,
      .blog .sidebar .recent-posts h4 a:hover,
      #footer .footer-top .footer-links ul a:hover  {
        color: {{$config->color_base}};
      }

      #header .logo h1 {
        border-left: {{$config->color_base}};
      }
      .back-to-top,
      .navbar .getstarted,
      .navbar .getstarted:focus,
      #hero .carousel-indicators li,
      #hero .btn-get-started,
      .section-title h2::after,
      .featured .icon-box:hover,
      .services .icon-box .icon,
      .services .icon-box:hover,
      .portfolio #portfolio-flters li:hover,
      .portfolio #portfolio-flters li.filter-active,
      .contact .php-email-form button[type=submit],
      .contact .php-email-form button[type=button],
      .blog .entry .entry-content .read-more a,
      .blog .blog-pagination li.active,
      .blog .blog-pagination li:hover,
      .blog .sidebar .search-form form button,
      .blog .sidebar .tags ul a:hover,
      #footer .footer-newsletter form input[type=submit],
      #footer .footer-top .social-links a:hover  {
        background: {{$config->color_base}};
      }

      .services .icon-box:hover,
      .contact .php-email-form input:focus,
      .contact .php-email-form textarea:focus {
        border-color: {{$config->color_base}};
      }

      #hero .btn-get-started, 
      .clients .swiper-pagination .swiper-pagination-bullet,
      .portfolio-details .portfolio-details-slider .swiper-pagination .swiper-pagination-bullet,
      .blog .sidebar .tags ul a:hover {
        border: {{$config->color_base}};
      }

      .clients .swiper-pagination .swiper-pagination-bullet-active,
      .skills .progress-bar,
      .portfolio-details .portfolio-details-slider .swiper-pagination .swiper-pagination-bullet-active,
      .offcanvas-header   {
        background-color: {{$config->color_base}} !important;
      }

      .back-to-top:hover{
        background: {{$config->color_3 }};
      }

      a:hover{
        color: {{$config->color_2 }};
      }
      #footer .footer-newsletter form input[type=submit]:hover {
        background: {{$config->color_2 }};
      }

      .services .icon-box:hover .icon::before {
        background: {{$config->color_3 }};
      }

      .navbar .getstarted:hover,
      .navbar .getstarted:focus:hover,
      .blog .entry .entry-content .read-more a:hover {
        background: {{$config->color_3 }};
      }
      #footer .footer-top .footer-links ul i{
        color: {{$config->color_3 }};
      }
      .services .icon-box .icon::before{
        background: {{$config->color_3 }};
      }
      .clients .swiper-pagination .swiper-pagination-bullet{
        background-color: {{$config->color_3}};
      }

  </style>
  <style>
    div.destacadosText{
      min-height: 72px; 
      max-height: 72px;
      -webkit-line-clamp: 3;
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box;
      -webkit-box-orient: vertical;
    }
  </style>

  <style>
    .calendar {
        display: flex;
        position: relative;
        padding: 16px;
        margin: 0 auto;
        max-width: 320px;
        background: white;
        border-radius: 4px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .month-year {
        position: absolute;
        bottom:62px;
        right: -27px;
        font-size: 2rem;
        line-height: 1;
        font-weight: 300;
        color: #94A3B8;
        transform: rotate(90deg);
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
    }

    .year {
        margin-left: 4px;
        color: #CBD5E1;
    }

    .days {
        display: flex;
        flex-wrap: wrap;
        flex-grow: 1;
        margin-right: 46px;
    }

    .day-label {
        position: relative;
        flex-basis: calc(14.286% - 2px);
        margin: 1px 1px 12px 1px;
        font-weight: 700;
        font-size: 0.65rem;
        text-transform: uppercase;
        color: #1E293B;
    }

    .day {
        position: relative;
        flex-basis: calc(14.286% - 2px);
        margin: 1px;
        border-radius: 999px;
        cursor: pointer;
        font-weight: 300;
    }

    .day.dull {
        color: #94A3B8;
    }

    .day.today {
        color: #0EA5E9;
        font-weight: 600;
    }

    .day::before {
        content: '';
        display: block;
        padding-top: 100%;
    }

    .daySelected {
        background: #E0F2FE;
        color: #0EA5E9;
        font-weight: 600;
    }

    .day .content {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
  </style>
  <style>
    .iconoDetalle{
      display: inline !important;
      font-size: 15px !important;
      color:  {{$config->color_base}} !important;
    }
  </style>
  
@endif

