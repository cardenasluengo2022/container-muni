<div class="container">

  @foreach ($portadas2 as $i => $p)
  <div class="row" style="margin-bottom: 50px">

    <div class="col-lg-6 @if ($i % 2)order-last @endif" >
      <img src="{{ asset('storage/'.$p->imagen ) }}" alt="" class="img-fluid">
    </div>

    <div class="col-lg-6 pt-4 pt-lg-0 content @if ($i % 2)order-first @endif">
      <h3>{{$p->titular}}</h3>
      {!! Str::of($p->texto, 600)->words(140) !!}
      <br />
      <a href="{{$p->slug}}" style="
        top: 0;
        right: 0;
        bottom: 0;
        border: 0;
        background: none;
        font-size: 16px;
        padding: 10px 30px;
        display: -webkit-inline-box;
        background: {{$config->color_principal}};
        color: #fff;
        transition: 0.3s;
        float: right;
        border-radius: 50px;">
        Seguir Leyendo
      </a>
    </div>
  </div>
  @endforeach
</div>