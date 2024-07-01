@extends('templates.principal-template')

@section('contenido')
<section id="breadcrumbs" class="breadcrumbs">
  <div class="container">

    <ol>
      <li><a href="/">Inicio</a></li>
      <li><a href="/categoriaEmprendedores">Chillanejos Emprendedores</a></li>
    </ol>
    <h2> Inscribe tu emprendimiento</h2>

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
              <div class="col-lg-12 col-md-12 align-items-stretch">
                <section id="contact" class="contact">
                  <div class="row">
                   
                    
                   
                    <div class="col-lg-12">
                      <form action="{{ route('store_emprende') }}" method="POST" role="form" class="php-email-form needs-validation" id="store_emprende_form" novalidate autocomplete="no">
                        @csrf
                        <div id="iForm">
                        <h5>Datos del Emprendedor/a</h5>
                        <div class="row">
                          <div class="col-md-4 form-group">
                            <input type="text" name="rut_emprendedor" class="form-control" id="rut_emprendedor" placeholder="Rut" required >
                            <div class="invalid-feedback">
                              El Rut no es válido
                            </div>
                          </div>
                          <div class="col-md-8 form-group mt-3 mt-md-0">
                            <input type="email" class="form-control" name="email_emprendedor" id="email_emprendedor" placeholder="Email" required>
                            <div class="invalid-feedback">
                              El Email no es válido
                            </div>
                          </div>
                        </div>
                        <div class="row mt-3">
                          <div class="col-md-4 form-group">
                            <input type="text" name="nombre_emprendedor" class="form-control" id="nombre_emprendedor" placeholder="Nombre" required pattern="\w{3,60}">
                            <div class="invalid-feedback">
                              El Nombre no es válido
                            </div>
                          </div>
                          <div class="col-md-4 form-group">
                            <input type="text" name="apellidoP_emprendedor" class="form-control" id="apellidoP_emprendedor" placeholder="Apellido Paterno" required pattern="\w{3,60}">
                            <div class="invalid-feedback">
                              El Apellido Paterno no es válido
                            </div>
                          </div>
                          <div class="col-md-4 form-group">
                            <input type="text" name="apellidoM_emprendedor" class="form-control" id="apellidoM_emprendedor" placeholder="Apellido Materno" required pattern="\w{3,60}">
                            <div class="invalid-feedback">
                              El Apellido Materno no es válido
                            </div>
                          </div>
                        </div>

                        <div class="row mt-3">
                          <div class="col-md-6 form-group">
                            <input type="password" class="form-control" name="passwd" id="passwd" placeholder="Contraseña" required>
                            <div class="invalid-feedback">
                              La contraseña no es válida
                            </div>
                          </div>
                          <div class="col-md-6 form-group">
                            <input type="password" class="form-control" name="passwd2" id="passwd2" placeholder="Repetir contraseña" required>
                            <div class="invalid-feedback">
                              Las contraseñas deben ser iguales
                            </div>
                          </div>
                        </div>
                        <hr>
                        <h5>Datos del Emprendimiento</h5>
                        <div class="row mt-3">
                          <div class="col-md-6 form-group">
                            <input type="text" class="form-control" name="nombre_emprendimiento" id="nombre_emprendimiento" placeholder="Nombre Emprendimiento" required>
                            <div class="invalid-feedback">
                              El nombre del emprendimiento no es válido
                            </div>
                          </div>
                          <div class="col-md-6 form-group">
                            <select class="form-control form-select" aria-label="Default select example" required name="categoria" id="categoria">
                              <option value="">Seleccione una categoría</option>
                               
                            </select>
                            <div class="invalid-feedback">
                              La categoría del emprendimiento no es válida
                            </div>
                          </div>
                        </div>
                        
                        </div>

                        <div class="my-3">
                          <div class="loading">Loading</div>
                          <div class="error-message"></div>
                          <div class="sent-message">Te has registrado como emprendedor. <br>Pronto recibirás un email de confirmación.  Gracias!</div>
                        </div>
                        <div class="text-center"><button type="submit" id="btn_enviar">Inscribir emprendimiento</button></div>
                      </form>
                    </div>
        
                  </div>
                </section>
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
<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>

<script>
    var option = document.querySelector("#menu_emprendedores")
    option.classList.add("active")

    // oír los cambios en la caja de texto e ir dando formato al RUT
    document.addEventListener('input', (e) => {
      const rut = document.getElementById('rut_emprendedor');

      if (e.target === rut) {
        let rutFormateado = darFormatoRUT(rut.value);
        rut.value = rutFormateado;
      }
    });

    // dar formato XX.XXX.XXX-X
    function darFormatoRUT(rut) {
      // dejar solo números y letras 'k'
      const rutLimpio = rut.replace(/[^0-9kK]/g, '');

      // asilar el cuerpo del dígito verificador
      const cuerpo = rutLimpio.slice(0, -1);
      const dv = rutLimpio.slice(-1).toUpperCase();

      if (rutLimpio.length < 2) return rutLimpio;

      // colocar los separadores de miles al cuerpo
      let cuerpoFormatoMiles = cuerpo
        .toString()
        .split('')
        .reverse()
        .join('')
        .replace(/(?=\d*\.?)(\d{3})/g, '$1.');

      cuerpoFormatoMiles = cuerpoFormatoMiles
        .split('')
        .reverse()
        .join('')
        .replace(/^[\.]/, '');

      return `${cuerpoFormatoMiles}-${dv}`;
    }


    function ejecutarValidacion() {
    const rut = document.getElementById('rut').value;
    const resultado = validarRUT(rut);
    const salida = document.querySelector('.salida');

    if (!rut) {
      salida.innerHTML = `<p style="color: red;">Debes ingresar un RUT</p>`;
    } else if (resultado === true) {
      salida.innerHTML = `<p style="color: darkgreen;">El RUT ${rut} es válido</p>`;
    } else {
      salida.innerHTML = `<p style="color: red;">El RUT ${rut} no es válido</p>`;
    }

    document.getElementById('rut').value = '';
  }
</script>  
<script>
    $(document).ready(function() {
      $.ajax({
        type: 'GET',
        url: "{{url('/nuevoEmprendedor/getCategorias')}}",
        success: function(categorias) {
          var result = '';
          categorias.forEach(el => {
            console.log(el);
            $('#categoria').append(new Option(el.nombre, el.id));
          });
        }
      });
    });
</script>  
@endsection