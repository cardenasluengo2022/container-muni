      <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <!-- pelotita -->
        @if (isset($portadas) && count($portadas) > 1)
          <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
        @else
         <ol class="carousel-indicators" id="hero-carousel-indicators" style="display: none"></ol>
        @endif
        

        <div class="carousel-inner" role="listbox">
                <!-- Slide 1 -->
          @php
            $disk = Storage::disk('gcs');
          @endphp
          @foreach ($portadas as $p)
            <div @if ($p->titular != "" || $p->subtitulo != "") class="carousel-item active" @else class="carousel-item sinDatos active" @endif 
              style="background-image: url({{ $disk->url($p->imagen )  }})">
              <div class="carousel-container">
                <div class="carousel-content">

                  @if ($p->titular != "")
                  <h2 class="animate__animated animate__fadeInDown"> {{$p->titular}}</span></h2>
                  @endif

                  @if ($p->subtitulo != "")
                  <p class="animate__animated animate__fadeInUp">{{$p->subtitulo}}</p>
                  @endif

                  @if ($p->slug != "")
                  <a href="{{$p->slug}}" class="btn-get-started animate__animated animate__fadeInUp">Leer mas</a>
                  @endif

                </div>
              </div>
            </div>  
          @endforeach
        </div>

        @if (isset($portadas) && count($portadas) > 1)
          <!-- controles -->
        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>
        @endif

      </div>
    