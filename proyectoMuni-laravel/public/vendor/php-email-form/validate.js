/**
* PHP Email Form Validation - v3.6
* URL: https://bootstrapmade.com/php-email-form/
* Author: BootstrapMade.com
*/
(function () {
  "use strict";

  let forms = document.querySelectorAll('.php-email-form');
  let inputRut = document.getElementById('rut_emprendedor');

  forms.forEach( function(e) {
    e.addEventListener('submit', function(event) {
      event.preventDefault();

      let thisForm = this;

      let action = thisForm.getAttribute('action');
      let recaptcha = thisForm.getAttribute('data-recaptcha-site-key');
      
      if( ! action ) {
        displayError(thisForm, 'The form action property is not set!');
        return;
      }
      thisForm.querySelector('.error-message').classList.remove('d-block');
      thisForm.querySelector('.sent-message').classList.remove('d-block');

      let formData = new FormData( thisForm );

      if ( recaptcha ) {
        if(typeof grecaptcha !== "undefined" ) {
          grecaptcha.ready(function() {
            try {
              grecaptcha.execute(recaptcha, {action: 'php_email_form_submit'})
              .then(token => {
                formData.set('recaptcha-response', token);
                php_email_form_submit(thisForm, action, formData);
              })
            } catch(error) {
              displayError(thisForm, error);
            }
          });
        } else {
          displayError(thisForm, 'The reCaptcha javascript API url is not loaded!')
        }
      } else {
        //validate
        //let nombre = document.getElementById('nombre_rtt');
        
        if (!thisForm.checkValidity()) {

          

          event.preventDefault()
          event.stopPropagation()
        }
        
        thisForm.classList.add('was-validated')

        if(thisForm.getAttribute('id') === 'store_alert_form'){
          if($('#latitude').val() == "" || $('#longitude').val() == ""){
            $('#invalid_direccion').css("display", "block");
  
            $('#direccion').removeClass('is-valid is-invalid')
            .addClass('is-invalid');
            thisForm.classList.remove('was-validated')
            
          }
        }
        
        

        if(thisForm.checkValidity()){
          thisForm.querySelector('.loading').classList.add('d-block');
          php_email_form_submit(thisForm, action, formData);
        }
        
       
      }
    });
  });

  const error = document.querySelector('.error');

  inputRut.addEventListener('input', event => {
    if(!verificaRut(inputRut.value)){
      inputRut.setCustomValidity("el rut no es válido!");
    }else{
      inputRut.setCustomValidity("");
      
    }
    inputRut.checkValidity();
  });

   function verificaRut(t) {
    // dejar solo números y letras 'k'
    const rutLimpio = t.replace(/[^0-9kK]/g, '');

    // verificar que ingrese al menos 2 caracteres válidos
    if (rutLimpio.length < 2) return false;

    // asilar el cuerpo del dígito verificador
    const cuerpo = rutLimpio.slice(0, -1);
    const dv = rutLimpio.slice(-1).toUpperCase();

    // validar que el cuerpo sea numérico
    if (!cuerpo.replace(/[^0-9]/g, '')) return false;

    // calcular el DV asociado al cuerpo del RUT
    const dvCalculado = calcularDV(cuerpo);

    // comparar el DV del RUT recibido con el DV calculado
    return dvCalculado == dv;
}
 function calcularDV(cuerpoRUT) {
  let suma = 1;
  let multiplo = 0;

  for (; cuerpoRUT; cuerpoRUT = Math.floor(cuerpoRUT / 10))
    suma = (suma + (cuerpoRUT % 10) * (9 - (multiplo++ % 6))) % 11;

  return suma ? suma - 1 : 'K';
}

  function php_email_form_submit(thisForm, action, formData) {
    thisForm.classList.remove('was-validated');
    fetch(action, {
      method: 'POST',
      body: formData,
      headers: {'X-Requested-With': 'XMLHttpRequest'}
    })
    .then(response => {
      if( response.ok ) {
        return response.text();
      } else {
        throw new Error(`${response.status} ${response.statusText} ${response.url}`); 
      }
    })
    .then(data => {
      thisForm.querySelector('.loading').classList.remove('d-block');
      console.log(data);
      if (data.includes("OK")) {
        thisForm.querySelector('.sent-message').classList.add('d-block');
        if(thisForm.getAttribute('id') === 'store_emprende_form'){
          
          thisForm.getElementById('iForm').style.display = 'none';
          thisForm.getElementById('btn_enviar').style.display = 'none';
        }
        thisForm.reset(); 
      } else {
        throw new Error(data ? data : 'Error al enviar los datos al servidor: ' + action); 
      }
    })
    .catch((error, errors, response, data) => {
      displayError(thisForm, error);
    });
  }

  function displayError(thisForm, error) {
    thisForm.querySelector('.loading').classList.remove('d-block');
    thisForm.querySelector('.error-message').innerHTML = error;
    thisForm.querySelector('.error-message').classList.add('d-block');
  }

})();
