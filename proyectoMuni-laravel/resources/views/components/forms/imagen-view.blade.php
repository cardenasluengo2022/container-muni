<!-- 
<div id="carouselExample" class="carousel slide">
    <div class="carousel-inner">
        @foreach(json_decode($lista) as $file)
            <div class="carousel-item active">
                <img src="{{ filter_var($file, FILTER_VALIDATE_URL) ? $file : Voyager::image($file) }}" class="d-block w-50" alt="...">
            </div>
        @endforeach

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
</div>
-->

<div class="container">
  <div class="slider-container">
    <div class="slider-list">
      @foreach(json_decode($lista) as $file)
        <div class="slider-list--child">
          <img src="{{ filter_var($file, FILTER_VALIDATE_URL) ? $file : Voyager::image($file) }}" >
        </div>
      @endforeach
    </div>
    <div class="slider-controller">
      <div class="slider-nav slider-nav__left"><i class="icon voyager-angle-left"></i></div>
      <div class="slider-nav slider-nav__right"><i class="icon voyager-angle-right"></i></div>
    </div>
  </div>
</div>