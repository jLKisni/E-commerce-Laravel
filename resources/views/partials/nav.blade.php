<header style="background: url('{{ asset('img/triangles.svg') }}');">
	
    <div class="top-nav container">
      <div class="top-nav-left">
          <div class="logo"><a href="{{route('landing-page')}}">Ecommerce</a></div>
          
      </div>
      <div class="top-nav-right">
          
          @include('partials.menus.main-right')
          
      </div>
    </div> <!-- end top-nav -->

</header>
