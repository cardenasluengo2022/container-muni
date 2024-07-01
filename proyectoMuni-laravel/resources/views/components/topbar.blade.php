@if (isset($configTopBar) && $configTopBar != null && $configTopBar->header_chek == 1)

<section id="topbar" class="d-flex align-items-center" style="{{$configTopBar->style}}" >
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
            
            @foreach ($configTopBar->datos as $dato => $icono)
            <i class="bi {{$icono}} d-flex align-items-center ms-3" style="color:{{$configTopBar->colorFont}}">
                <span style="color:{{$configTopBar->colorFont}}">{{$muni->{$dato} }}</span>
            </i>
            @endforeach

            
        </div>
        @if ($configTopBar->rrss_header != null && $configTopBar->rrss_header == 1 )
            <div class="social-links d-none d-md-flex align-items-center">
                @foreach ($rrss as $rs)
                <a href="{{$rs->url_base}}{{$rs->url}}" class="{{$rs->nombre}}" style="color:{{$configTopBar->colorFont}}">
                    <i class="{{$rs->icono}}"></i>
                </a>
                @endforeach
            </div>
        @endif
        
    </div>
</section> 

@endif

