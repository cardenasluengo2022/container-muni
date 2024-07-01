@extends('templates/principal-template')
@section('css')
    <style>
      #hero .sinDatos.carousel-item::before {
        background-color: inherit;
      }
      section#contact {
          padding: 0px 80px 80px 80px;
      }
      .contact .php-email-form button[type=button] {
        border: 0;
        border-radius: 50px;
        padding: 10px 24px;
        color: #fff;
        transition: 0.4s;
    }
    </style>
@endsection

@section('contenido')

  <!-- ======= Hero Section ======= -->
  @if (isset($pagPrincipal) && $pagPrincipal->portada_chek == 1)
  <section id="hero">
    <div class="hero-container">  
      <x-portada></x-portada>
    </div>
  </section>
  <!-- End Hero -->
  @else
  <br>
  @endif


  <main id="main">

    <!-- ======= Featured Section ======= -->
    <x-destacados></x-destacados>
    <!-- End Featured Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <x-seccionSegundaria></x-seccionSegundaria>
    </section><!-- End About Section -->

    @if (isset($pagPrincipal) && $pagPrincipal->alerta_chek == 1)
      <!-- ======= Alerta Section ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
          <div class="container">
            <h2>
              @if (isset($pagPrincipal) && $pagPrincipal->alerta_titulo != "" )
              {{$pagPrincipal->alerta_titulo}}
              @endif
            </h2>
              @if (isset($pagPrincipal) && $pagPrincipal->alerta_subtitulo != "" )
              <span>{{$pagPrincipal->alerta_subtitulo}}</span>
              @endif
          </div>
        </section>
        <section id="contact" class="contact">
          <div class="row">
            @if (isset($pagPrincipal) && $pagPrincipal->alerta_mapa == 1)
            <div class="col-lg-6 ">
              <div id="map" style="height: 100%"></div>
            </div>
            @endif
            <div class="col-lg-6">
              <form action="{{ route('store_alert') }}" method="POST" role="form" class="php-email-form needs-validation" id="store_alert_form" novalidate >
                @csrf
                <input type="hidden" id="latitude" name="latitude" value="">
                <input type="hidden" id="longitude" name="longitude" value="">
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="nombre_rtt" class="form-control" id="nombre_rtt" placeholder="Nombre" required pattern="\w{3,60}">
                    <div class="invalid-feedback">
                      El Nombre no es válido
                    </div>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email_rtt" id="email_rtt" placeholder="Email" required>
                    <div class="invalid-feedback">
                      El Email no es válido
                    </div>
                  </div>
                </div>
                <div class="form-group mt-3">
                  <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección" required>
                  <div class="invalid-feedback" id="invalid_direccion">
                    La dirección no es válida
                  </div>
                </div>
                <div class="form-group mt-3">
                  <select class="form-control form-select" aria-label="Default select example" required name="tipo_alerta" id="tipo_alerta">
                    <option value="">Seleccione un tipo de alerta</option>
                      @foreach ($tiposAlertas as $ta)
                        <option value="{{$ta->id}}">{{$ta->tipo}}</option>
                      @endforeach
                  </select>
                  <div class="invalid-feedback">
                    El tipo de alerta no es válido
                  </div>
                </div>
                <div class="form-group mt-3">
                  <textarea class="form-control" name="comentario" id="comentario" rows="5" placeholder="Mensaje" required></textarea>
                  <div class="invalid-feedback">
                    El comentario no es válido
                  </div>
                </div>
                <div class="my-3">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Tu mensaje fué enviado. Gracias!</div>
                </div>
                <div class="text-center"><button type="submit" id="btn_enviar">Enviar Alerta</button></div>
              </form>
            </div>

          </div>
        </section>
      <!-- End Alerta Section -->
    @endif


    <!-- ======= Services Section ======= -->
      <!--
      <section id="services" class="services">
        <div class="container">

          <div class="row">
            <div class="col-lg-4 col-md-6 align-items-stretch mt-4 mt-md-0">
              <div class="icon-box">
                <div class="icon"><i class="bi bi-bookmark-star"></i></div>
                <h4><a href="/autoridades">Autoridades</a></h4>
                
              </div>
            </div>

            <div class="col-lg-4 col-md-6 align-items-stretch mt-4 mt-md-0">
              <div class="icon-box">
                <div class="icon"><i class="bi bi-bookmark-star"></i></div>
                <h4><a href="">Departamentos Municipales</a></h4>
                
              </div>
            </div>

            <div class="col-lg-4 col-md-6 align-items-stretch mt-4 mt-lg-0">
              <div class="icon-box">
                <div class="icon"><i class="bi bi-bookmark-star"></i></div>
                <h4><a href="">Juntas de Vecinos</a></h4>
              
              </div>
            </div>

            <div class="col-lg-4 col-md-6 align-items-stretch mt-4">
              <div class="icon-box">
                <div class="icon"><i class="bi bi-bookmark-star"></i></div>
                <h4><a href="">Deporte</a></h4>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 align-items-stretch mt-4">
              <div class="icon-box">
                <div class="icon"><i class="bi bi-bookmark-star"></i></div>
                <h4><a href="">Cultura</a></h4>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 align-items-stretch mt-4">
              <div class="icon-box">
                <div class="icon"><i class="bi bi-bookmark-star"></i></div>
                <h4><a href="">Historia</a></h4>
              </div>
            </div>

          </div>

        </div>
      </section>
      -->
    <!-- End Services Section -->

    <!-- ======= Emprendimientos Section ======= -->
    @if (isset($pagPrincipal) && $pagPrincipal->emprendimientos_chek == 1)
    <section id="clients" class="clients">
      <div class="container">

        <div class="section-title">
          <a href="/categoriasEmprendedores"><h2>{{$pagPrincipal->titulo_emprendimientos}}</h2></a>
          <p>{{$pagPrincipal->subtitulo_emprendimientos}}</p>
          @if (isset($pagPrincipal) && $pagPrincipal->inscripcion_chek == 1)
            <a href="/nuevoEmprendimiento" style="
              background: none;
              font-size: 16px;
              padding: 10px 30px;
              display: -webkit-inline-box;
              background: {{$config->color_principal}};
              color: #fff;
              transition: 0.3s;
              margin-top:10px;
              border-radius: 50px;">
              Inscribe tu emprendimiento Aquí
            </a>
          @endif
        </div>

        <div class="clients-slider swiper">
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="{{asset('img/muni/naya.jpeg')}}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{asset('img/muni/greda.jpg')}}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{asset('img/muni/madera.png')}}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{asset('img/muni/fusion.png')}}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{asset('img/muni/gastro.jpg')}}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{asset('img/muni/turismo.jpg')}}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{asset('img/muni/p1.png')}}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{asset('img/muni/p5.png')}}" class="img-fluid" alt=""></div>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section>
    @endif
    <!-- End Emprendimientos Section -->

  </main><!-- End #main -->


@endsection

@if (isset($pagPrincipal) && $pagPrincipal->newlister_chek == 1)
  @section('footer')
  <div class="footer-newsletter">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          @if (isset($pagPrincipal) && $pagPrincipal->newlister_titulo != "")
            <h4>{{$pagPrincipal->newlister_titulo}}</h4>
          @endif
          @if (isset($pagPrincipal) && $pagPrincipal->newlister_subtitulo != "")
            <p>{{$pagPrincipal->newlister_subtitulo}}</p>
          @endif
        </div>
        <div class="col-lg-6">
          <form action="" method="post" class="needs-validation" id="store_newlister" novalidate>
            @csrf
            <input type="email" name="email" id="email_newlister" placeholder="Ingrese su Email">
            <input type="submit" value="Suscribirse" id="btn_suscribre">
          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection
@endif


@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyCKqh1B3F0Y2w8z_epvChxtviZG2NcqlDg&libraries=places"></script>
@if (isset($pagPrincipal) && $pagPrincipal->alerta_chek == 1)
<script>


  google.maps.event.addDomListener(window,'load',initialize);

  let map;

  async function initMap() {
    //@ts-ignore
    const { Map } = await google.maps.importLibrary("maps");

    map = new Map(document.getElementById("map"), {
      center: { lat: -36.6066167085018, lng: -72.10354377456648 },
      zoom: 15,
    });

  }

  initMap();
 

  function initialize(){

    const defaultBounds = {
        north: map.getCenter().lat() + 0.1,
        south: map.getCenter().lat() - 0.1,
        east: map.getCenter().lng() + 0.1,
        west: map.getCenter().lng() - 0.1,
    };

    var options = {
      bounds: defaultBounds,
      strictBounds: true,
      componentRestrictions: {country: "cl"}
    };

    var input =document.getElementById('direccion');
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    let marker = new google.maps.Marker();

    autocomplete.addListener('place_changed', function(){
      
      var place = autocomplete.getPlace();
      console.log(place);
      
      map.setCenter(place.geometry.location);
      map.setZoom(18);
      
      //const myLatLng = { lat: -25.363, lng: 131.044 };
      marker.setPosition(place.geometry.location);
      marker.setMap(map);
      // 
      $('#latitude').val( map.getCenter().lat() );
      $('#longitude').val(map.getCenter().lng());

      $('#invalid_direccion').css("display", "none");
      $('#direccion').removeClass("is-invalid");
      $('#direccion').addClass("is-valid");

      
    });
  }
      $('#direccion').on('input',function(e){
        $('#latitude').val("");
        $('#longitude').val("");

        if($('#latitude').val() == "" || $('#longitude').val() == ""){
          document.getElementById('store_alert_form').classList.remove('was-validated');
          $('#invalid_direccion').css("display", "block");
          $('#direccion').removeClass('is-valid is-invalid')
               .addClass('is-invalid');
               
        }


      });

     
</script>
@endif
<script type="text/javascript">

  var option = document.querySelector("#menu_inicio");
  option.classList.add("active");


  $("#store_newlister").submit(function(e){
      var d = $('#store_newlister').serialize();
      e.preventDefault();
   
      var email = $("#email_newlister").val();
   
      $.ajax({
         type:'POST',
         url:"{{ route('store_newlister') }}",
         data:d,
         success:function(data){
          console.log(data);
              if(data == "OK"){
                console.log("bien");
                $("#store_newlister").hide();
                var msg = "<h4>Gracias por suscribirte a nuestro contenido!!!</h4>"
                $("#store_newlister").parent().append(msg);
                $(".footer-newsletter").delay(1000).fadeOut(2600, "linear");
              }else{

                $("#store_newlister").hide();
                var msg = "<h4>Ha ocurrido un error al momento de suscribirte, reintentalo mas tarde</h4>"
                $("#store_newlister").parent().append(msg);
              }
         }
      });
  
  });

</script>
@endsection