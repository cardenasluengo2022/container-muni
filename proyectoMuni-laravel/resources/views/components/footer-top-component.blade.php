<div class="footer-top">
    <div class="container">
      <div class="row">

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Trámites Online</h4>
          <ul>
            @foreach ($tramitesOnline as $to)
            <li>
                <i class="bx bx-chevron-right"></i> 
                <a href="/tramites/{{$to->slug}}">{{$to->nombre}}</a>
            </li>
            @endforeach
            
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Direcciones Municipales</h4>
          <ul>
            @foreach ($direcciones as $d)
            <li><i class="bx bx-chevron-right"></i> <a href="/direccion/{{$d->slug}}">{{$d->nombre}}</a></li>
            @endforeach
          </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-contact">
          <h4>Contáctanos</h4>
          <p>
            {{$muni->direccion}}, <br>
            {{$ciudad->nombre}}<br><br>
            <strong>Fono:</strong> {{$muni->fono1}}<br>
            <strong>Email:</strong> {{$muni->email}}<br>
          </p>
          <div class="social-links mt-3">
            @foreach ($rrss as $rs)
                <a href="{{$rs->url_base}}{{$rs->url}}" class="{{$rs->nombre}}">
                    <i class="{{$rs->icono}}"></i>
                </a>
            @endforeach
          </div>

        </div>

        <div class="col-lg-3 col-md-6 footer-info">
          <h3>Municipalidad de Chillán</h3>
          <p>
            Nos proyectamos como una institución moderna y transparente, 
            con una profunda cultura de servicio hacia la comunidad en todos nuestros procesos, 
            siendo un referente para las municipalidades del país. Visualizamos una institución realizadora, 
            con una participación activa en el progreso material y social de la ciudad, 
            liderando los cambios en las condiciones de vida de todos nuestros habitantes.
          </p>
          
        </div>

      </div>
    </div>
  </div>

  <div class="container">
    <div class="copyright">
      &copy; Copyright <strong><span>iTempus ltda</span></strong>. Todos los derechos reservados
    </div>
  </div>