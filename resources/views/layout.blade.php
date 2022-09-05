<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Med-bot, Your Partner in Health">
    <meta name="theme-color" content="#478ac9">

    <title>{{$title}}</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('css/'.$style.'.css') }}" media="screen">

    <script class="u-script" type="text/javascript" src="{{ asset('js/jquery.js') }}" "="" defer=""></script>
    <script class="u-script" type="text/javascript" src="{{ asset('js/styles.js') }}" "="" defer=""></script>

    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster:400">
    
    <script type="application/ld+json">{
      "@context": "http://schema.org",
      "@type": "Organization",
      "name": "",
      "logo": "images/logo.png"
    }
    </script>
  </head>

  <body class="u-body u-xl-mode" data-lang="en">
    <header class="u-clearfix u-header u-header" id="sec-3e0f">
      <div class="u-clearfix u-sheet u-sheet-1">
        <a href="" data-page-id="1781919166" class="u-image u-logo u-image-1" data-image-width="229" data-image-height="220" title="Home">
          <img src="{{ asset('images/logo.png') }}" class="u-logo-image u-logo-image-1">
        </a>
        <p class="u-custom-font u-font-lobster u-text u-text-default u-text-1">Medicorps.Ltd</p>
        <nav class="u-menu u-menu-one-level u-offcanvas u-menu-1">
          <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px;">
            <a class="u-button-style u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#">
              <svg class="u-svg-link" viewBox="0 0 24 24">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#menu-hamburger"></use>
              </svg>
              <svg class="u-svg-content" version="1.1" id="menu-hamburger" viewBox="0 0 16 16" x="0px" y="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
                <g>
                  <rect y="1" width="16" height="2"></rect>
                  <rect y="7" width="16" height="2"></rect>
                  <rect y="13" width="16" height="2"></rect>
                </g>
              </svg>
            </a>
          </div>

          @auth
          <div class="u-custom-menu u-nav-container">
            <ul class="u-nav u-unstyled u-nav-1">
              <li class="u-nav-item">
                <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="/medbot/public/" style="padding: 10px 20px;">Home</a>
              </li>
              <li class="u-nav-item">
                <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="/medbot/public/about" style="padding: 10px 20px;">About</a>
              </li>
              <li class="u-nav-item">
                <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="/medbot/public/logout" style="padding: 10px 20px;">Logout</a>
              </li>
            </ul>
          </div>
          @else
          <div class="u-custom-menu u-nav-container">
            <ul class="u-nav u-unstyled u-nav-1">
              <li class="u-nav-item">
                <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="/medbot/public/" style="padding: 10px 20px;">Home</a>
              </li>
              <li class="u-nav-item">
                <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="/medbot/public/about" style="padding: 10px 20px;">About</a>
              </li>
              <li class="u-nav-item">
                <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="/medbot/public/login/user" style="padding: 10px 20px;">Login</a>
              </li>
            </ul>
          </div>
          @endauth

        </nav>

        @auth
        <form action="#" method="get" class="u-border-1 u-border-grey-30 u-search u-search-left u-white u-search-1">
          <button class="u-search-button" type="submit">
            <span class="u-search-icon u-spacing-10">
              <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 56.966 56.966">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-cd36"></use>
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="svg-cd36" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" class="u-svg-content">
                <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"></path>
              </svg>
            </span>
          </button>
          <input class="u-search-input" type="search" name="search" value="" placeholder="Search">
          <input type="hidden" name="formServices" value="62357873878bb1c7e0f64a441921ee6e">
        </form>
        @endauth

      </div>
    </header>

    @yield('content')    
    
    <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-7727">
      <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
          <p class="u-small-text u-text u-text-variant u-text-1">Made for Thesis: Med-bot: Pulse Rate and Blood Pressure Monitor<br>@2022
          </p>
      </div>
    </footer>
  </body>
</html>